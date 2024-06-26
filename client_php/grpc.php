<?php
require dirname(__FILE__).'/vendor/autoload.php'; // 引入 gRPC PHP 扩展的自动加载文件

// 导入命名空间
use GCN\GCNRequest;
use GCN\GraphData;
use GCN\ModelParams;
use GCN\Node;
use GCN\Edge;
use GCN\HistoryData;
use GCN\YearData;
use GCN\PlaceData;
use GCN\GCNServiceClient;

// 进行grpc请求，获取gcn处理后的数据，返回json字符串
// 参数为years年份数组,默认为2015-2019
function GCN_request($years)
{
    if (!extension_loaded('grpc')){
        die("grpc extension don`t find from php.ini! Check the .ini file or grpc extension.");
    }
    try {
        $client = new GCNServiceClient('viogami.me:9999', [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
        ]);
    } catch (\Throwable $e) {
        // 打印错误信息
        die("Error connecting to gRPC server: " . $e->getMessage() . "\n");
    }
    
    // 创建一个实例的图数据
    $G_example = new GraphData();
    // 从node.json读取节点
    $node = json_decode(file_get_contents('data/node.json'), true);
    $G_example->setNodes(array_map(function($node) {
        return (new Node())->setId($node['Id'])->setFeatures($node['Features']);
    }, $node));
    // 从edge.json读取边
    $edge = json_decode(file_get_contents('data/edge.json'), true);
    $G_example->setEdges(array_map(function($edge) {
        return (new Edge())->setSourceId($edge['source_id'])->setTargetId($edge['target_id']);
    }, $edge));

    // 设置模型参数
    $Params = new ModelParams();
    $Params->setInputDims(1);
    $Params->setHiddenDims(16);
    $Params->setOutputDims(1);

    // 设置HistoryData
    $HistoryData = new HistoryData();

    $year_data_array = [];
    foreach ($years as $year) {
        $YearData = new YearData();
        $YearData->setYear($year);
        // 从data/data_$year.json读取数据
        $json_data = json_decode(file_get_contents("data/data_$year.json"), true);
        $place_data_array = [];
        foreach ($json_data as $place_data) {
            $PlaceData = new PlaceData();
            $PlaceData->setPlace($place_data['地点']);
            $PlaceData->setLongitude($place_data['经度']);
            $PlaceData->setLatitude($place_data['纬度']);
            $PlaceData->setTotalPeople($place_data['总人数']);
            $place_data_array[] = $PlaceData;
        }
        $YearData->setPlaceData($place_data_array);
        $year_data_array[] = $YearData;
    }
    $HistoryData->setYearData($year_data_array);

    // 创建一个gcn请求
    $request = new GCNRequest();
    $request->setGraph($G_example);
    $request->setParams($Params);
    $request->setHistoryData($HistoryData);
    

    // 发送请求并接收响应
    list($response, $status) = $client->ProcessGCN($request)->wait();
    if ($status->code !== Grpc\STATUS_OK) {
        // gRPC 请求出错
        die('Error calling grpc server -> ProcessGraph: ' . $status->details);
    }
    
    $NodeScores = [];
    foreach ($response->getNodeScores() as $key => $value) {
        $NodeScores[$key] = $value;
    }

    // 获取HTML字符串
    $html = $response->getHtml();

    // 存储返回的string为html
    return ['nodeScores' => json_encode($NodeScores), 'html' => $html];
}


