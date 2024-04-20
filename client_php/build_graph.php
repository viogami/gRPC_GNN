<?php

// 计算节点之间的距离矩阵
function compute_distance_matrix($df) {
    $locations = array_map(function($row) {
        return [$row['经度'], $row['纬度']];
    }, $df);
    $num_locations = count($locations);
    $distance_matrix = array_fill(0, $num_locations, array_fill(0, $num_locations, 0));
    for ($i = 0; $i < $num_locations; $i++) {
        for ($j = $i + 1; $j < $num_locations; $j++) {
            $distance = sqrt(pow($locations[$i][0] - $locations[$j][0], 2) + pow($locations[$i][1] - $locations[$j][1], 2));
            $distance_matrix[$i][$j] = $distance_matrix[$j][$i] = $distance;
        }
    }
    return $distance_matrix;
}

// 计算衡量值
function compute_measure($df, $k) {
    $distance_matrix = compute_distance_matrix($df);
    $num_locations = count($distance_matrix);
    $measure_matrix = array_fill(0, $num_locations, array_fill(0, $num_locations, 0));
    for ($i = 0; $i < $num_locations; $i++) {
        for ($j = $i + 1; $j < $num_locations; $j++) {
            $measure = $distance_matrix[$i][$j] * (1 - $k) + $k * ($df[$i]['总人数'] + $df[$j]['总人数']);
            $measure_matrix[$i][$j] = $measure_matrix[$j][$i] = $measure;
        }
    }
    return $measure_matrix;
}

// 判断是否存在边
function edges_from_measure($measure_matrix, $threshold) {
    $edges = [];
    $num_locations = count($measure_matrix);
    for ($i = 0; $i < $num_locations; $i++) {
        for ($j = $i + 1; $j < $num_locations; $j++) {
            if ($measure_matrix[$i][$j] > $threshold) {
                $edges[] = [$i, $j];
            }
        }
    }
    return $edges;
}

// 构建数据
function build_data($year_data,$k, $threshold) {
    // 计算衡量值
    $measure_matrix = compute_measure($year_data, $k);

    // 获取边信息
    $edges = edges_from_measure($measure_matrix, $threshold);

    // 将边信息数组转换为所需形式的字典列表
    $edges_list = array_map(function($edge) {
        return ['source_id' => strval($edge[0]), 'target_id' => strval($edge[1])];
    }, $edges);

    // 节点数据
    $nodes_list = [];
    foreach ($year_data as $index => $row) {
        $nodes_list[] = ['Id' => strval($index), 'Features' => [(float)$row['总人数']]];
    }

    return [$nodes_list, $edges_list];
}