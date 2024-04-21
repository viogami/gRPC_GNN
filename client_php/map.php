<?php
require_once 'vendor/autoload.php';
require 'build_graph.php';
require 'grpc.php';


// 从数据库创建数据，参数为years年份数组,默认为2015-2019,并将数据保存为json
function fetch_data($years)
{
    // 创建PDO实例
    $host = 'localhost';
    $db   = 'kqdb';
    $user = 'kqdb';
    $pass = 'yourpassword';
    $charset = 'utf8';
    // 数据库连接
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    // 从ycdata表获取数据
    $stmt = $pdo->query('SELECT * FROM ycdata');
    $data = $stmt->fetchAll();

    // 获取地点列表
    $location = [];
    foreach ($data as $row) {
        $location[$row['地点']] = ['经度' => $row['经度'], '纬度' => $row['纬度']];
    }

    // 转换时间列为年份
    foreach ($data as &$row) {
        $row['年份'] = date('Y', strtotime($row['时间']));
    }

    // 计算每场上映的总人数
    foreach ($data as &$row) {
        $row['总人数'] = $row['上映场次'] * $row['人数'];
    }

    // 按照地点和年份计算总人数
    $summary = [];
    foreach ($data as $row) {
        if (!isset($summary[$row['地点']])) {
            $summary[$row['地点']] = [];
        }
        if (!isset($summary[$row['地点']][$row['年份']])) {
            $summary[$row['地点']][$row['年份']] = 0;
        }
        $summary[$row['地点']][$row['年份']] += $row['总人数'];
    }

    // 遍历summary表的每一列，创建新表存放每年每个地点的位置和人数信息
    $year_data = [];
    foreach ($years as $year) {
        foreach ($summary as $place => $data) {
            if (isset($data[$year]) && $data[$year] != 0) {
                $year_data[$year][] = [
                    '地点' => $place,
                    '经度' => $location[$place]['经度'],
                    '纬度' => $location[$place]['纬度'],
                    '总人数' => $data[$year],
                ];
            }
        }
        // 将每一年的数据转换为JSON格式并保存到文件中
        $json_data = json_encode($year_data[$year], JSON_UNESCAPED_UNICODE);
        file_put_contents("data/data_$year.json", $json_data);
    }

    // 构造图数据
    //获得最新一年
    $year = $years[count($years) - 1];
    $k = 0.01;
    $threshold = 869;
    $node = build_data($year_data[$year], $k, $threshold)[0];
    $edge = build_data($year_data[$year], $k, $threshold)[1];

    // 保存数据为json
    file_put_contents('data/node.json', json_encode($node, JSON_UNESCAPED_UNICODE));
    file_put_contents('data/edge.json', json_encode($edge, JSON_UNESCAPED_UNICODE));
}

// 定义全局变量years
$years = range(2015, 2019);

// 判断是否有图数据以及历史数据的json
if (!file_exists('data/node.json') || !file_exists('data/edge.json') || !file_exists('data/data_2015.json') || !file_exists('data/data_2016.json') || !file_exists('data/data_2017.json') || !file_exists('data/data_2018.json') || !file_exists('data/data_2019.json')){
    fetch_data($years);
}

// 如果没有map的html，则通过grpc调用生成
if (!file_exists('map.html')) {
    // 调用gRPC服务
    $res = GCN_request($years);
    file_put_contents('data/res.json', $res);
}

// 如果收到POST请求(即按下了更新界面)，调用gRPC服务
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fetch_data($years);

    $res = GCN_request($years);
    file_put_contents('data/res.json', $res);

    // 刷新页面
    header('Location: map.php');
}

// 显示html页面
// 注意，该文件由grpc的python服务端生成，不是由php读取grpc回复生成
// 如果需要，可以直接访问http://kunqu.viogami.me/kunqu/map.html
readfile('map.html');

?>

<form method="post">
    <input type="submit" value="更新页面">
</form>