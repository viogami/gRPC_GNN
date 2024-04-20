<?php
// 从接口获取数据（假设接口返回 JSON 格式数据）

$data_theatre = [[]];

$data_province = [
    '四川省' => 20,
    '江西省' => 25,
    '福建省' => 30,
    '浙江省' => 90,
    '江苏省' => 70,
    '安徽省' => 50,
];

$data_year = range(2015, 2019);

// 输出地图模板
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>中国昆曲热度预测</title>
                <script type="text/javascript" src="https://assets.pyecharts.org/assets/v5/echarts.min.js"></script>
            <script type="text/javascript" src="https://assets.pyecharts.org/assets/v5/maps/china.js"></script>

    
</head>
<body style="background-color: #FFFFFF">
            <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 12px 16px;
            transition: 0.3s;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #ccc;
        }

        .chart-container {
            display: block;
        }

        .chart-container:nth-child(n+2) {
            display: none;
        }
    </style>
    <div class="tab">
            <button class="tablinks" onclick="showChart(event, '881150e3593c4f50a44fb9a40a2e74b4')">各省昆曲热度</button>
            <button class="tablinks" onclick="showChart(event, '9052c75a3a7f478e832a4a3b78762d53')">各大昆曲剧院热度</button>
    </div>

    <div class="box">
                <div id="881150e3593c4f50a44fb9a40a2e74b4" class="chart-container" style="width:80vw; height:80vh; text-align:center; margin: auto"></div>
    <script>
            document.getElementById('881150e3593c4f50a44fb9a40a2e74b4').style.width = document.getElementById('881150e3593c4f50a44fb9a40a2e74b4').parentNode.clientWidth + 'px';
        var chart_881150e3593c4f50a44fb9a40a2e74b4 = echarts.init(
            document.getElementById('881150e3593c4f50a44fb9a40a2e74b4'), 'white', {renderer: 'canvas'});
        var option_881150e3593c4f50a44fb9a40a2e74b4 = {
    "baseOption": {
        "series": [
            {
                "type": "map",
                "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                "label": {
                    "show": false,
                    "margin": 8
                },
                "map": "china",
                "data": [
                    {
                        "name": "\u56db\u5ddd\u7701",
                        "value": 20
                    },
                    {
                        "name": "\u6c5f\u897f\u7701",
                        "value": 25
                    },
                    {
                        "name": "\u798f\u5efa\u7701",
                        "value": 30
                    },
                    {
                        "name": "\u6d59\u6c5f\u7701",
                        "value": 90
                    },
                    {
                        "name": "\u6c5f\u82cf\u7701",
                        "value": 70
                    },
                    {
                        "name": "\u5b89\u5fbd\u7701",
                        "value": 50
                    }
                ],
                "roam": true,
                "aspectScale": 0.75,
                "nameProperty": "name",
                "selectedMode": true,
                "zoom": 1,
                "zlevel": 0,
                "z": 2,
                "seriesLayoutBy": "column",
                "datasetIndex": 0,
                "mapValueCalculation": "sum",
                "showLegendSymbol": false,
                "emphasis": {}
            }
        ],
        "timeline": {
            "axisType": "category",
            "currentIndex": 4,
            "orient": "horizontal",
            "autoPlay": false,
            "controlPosition": "left",
            "loop": false,
            "rewind": false,
            "show": true,
            "inverse": false,
            "symbol": "diamond",
            "playInterval": 1000,
            "bottom": "-5px",
            "progress": {},
            "data": [
                "2015\u5e74",
                "2016\u5e74",
                "2017\u5e74",
                "2018\u5e74",
                "2019\u5e74"
            ]
        },
        "visualMap": {
            "show": true,
            "type": "piecewise",
            "min": 0,
            "max": 100,
            "inRange": {
                "color": [
                    "#50a3ba",
                    "#eac763",
                    "#d94e5d"
                ]
            },
            "calculable": true,
            "inverse": false,
            "splitNumber": 5,
            "hoverLink": true,
            "orient": "vertical",
            "padding": 5,
            "showLabel": true,
            "itemWidth": 20,
            "itemHeight": 14,
            "borderWidth": 0
        },
        "legend": [
            {
                "data": [
                    "\u6606\u66f2\u7701\u70ed\u5ea6"
                ],
                "selected": {},
                "show": false,
                "padding": 5,
                "itemGap": 10,
                "itemWidth": 25,
                "itemHeight": 14,
                "backgroundColor": "transparent",
                "borderColor": "#ccc",
                "borderRadius": 0,
                "pageButtonItemGap": 5,
                "pageButtonPosition": "end",
                "pageFormatter": "{current}/{total}",
                "pageIconColor": "#2f4554",
                "pageIconInactiveColor": "#aaa",
                "pageIconSize": 15,
                "animationDurationUpdate": 800,
                "selector": false,
                "selectorPosition": "auto",
                "selectorItemGap": 7,
                "selectorButtonGap": 10
            }
        ]
    },
    "options": [
        {
            "series": [
                {
                    "type": "map",
                    "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                    "label": {
                        "show": false,
                        "margin": 8
                    },
                    "map": "china",
                    "data": [
                        {
                            "name": "\u56db\u5ddd\u7701",
                            "value": 20
                        },
                        {
                            "name": "\u6c5f\u897f\u7701",
                            "value": 25
                        },
                        {
                            "name": "\u798f\u5efa\u7701",
                            "value": 30
                        },
                        {
                            "name": "\u6d59\u6c5f\u7701",
                            "value": 90
                        },
                        {
                            "name": "\u6c5f\u82cf\u7701",
                            "value": 70
                        },
                        {
                            "name": "\u5b89\u5fbd\u7701",
                            "value": 50
                        }
                    ],
                    "roam": true,
                    "aspectScale": 0.75,
                    "nameProperty": "name",
                    "selectedMode": true,
                    "zoom": 1,
                    "zlevel": 0,
                    "z": 2,
                    "seriesLayoutBy": "column",
                    "datasetIndex": 0,
                    "mapValueCalculation": "sum",
                    "showLegendSymbol": false,
                    "emphasis": {}
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2015\u5e74\u6606\u66f2\u5404\u7701\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 100,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "map",
                    "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                    "label": {
                        "show": false,
                        "margin": 8
                    },
                    "map": "china",
                    "data": [
                        {
                            "name": "\u56db\u5ddd\u7701",
                            "value": 20
                        },
                        {
                            "name": "\u6c5f\u897f\u7701",
                            "value": 25
                        },
                        {
                            "name": "\u798f\u5efa\u7701",
                            "value": 30
                        },
                        {
                            "name": "\u6d59\u6c5f\u7701",
                            "value": 90
                        },
                        {
                            "name": "\u6c5f\u82cf\u7701",
                            "value": 70
                        },
                        {
                            "name": "\u5b89\u5fbd\u7701",
                            "value": 50
                        }
                    ],
                    "roam": true,
                    "aspectScale": 0.75,
                    "nameProperty": "name",
                    "selectedMode": true,
                    "zoom": 1,
                    "zlevel": 0,
                    "z": 2,
                    "seriesLayoutBy": "column",
                    "datasetIndex": 0,
                    "mapValueCalculation": "sum",
                    "showLegendSymbol": false,
                    "emphasis": {}
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2016\u5e74\u6606\u66f2\u5404\u7701\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 100,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "map",
                    "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                    "label": {
                        "show": false,
                        "margin": 8
                    },
                    "map": "china",
                    "data": [
                        {
                            "name": "\u56db\u5ddd\u7701",
                            "value": 20
                        },
                        {
                            "name": "\u6c5f\u897f\u7701",
                            "value": 25
                        },
                        {
                            "name": "\u798f\u5efa\u7701",
                            "value": 30
                        },
                        {
                            "name": "\u6d59\u6c5f\u7701",
                            "value": 90
                        },
                        {
                            "name": "\u6c5f\u82cf\u7701",
                            "value": 70
                        },
                        {
                            "name": "\u5b89\u5fbd\u7701",
                            "value": 50
                        }
                    ],
                    "roam": true,
                    "aspectScale": 0.75,
                    "nameProperty": "name",
                    "selectedMode": true,
                    "zoom": 1,
                    "zlevel": 0,
                    "z": 2,
                    "seriesLayoutBy": "column",
                    "datasetIndex": 0,
                    "mapValueCalculation": "sum",
                    "showLegendSymbol": false,
                    "emphasis": {}
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2017\u5e74\u6606\u66f2\u5404\u7701\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 100,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "map",
                    "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                    "label": {
                        "show": false,
                        "margin": 8
                    },
                    "map": "china",
                    "data": [
                        {
                            "name": "\u56db\u5ddd\u7701",
                            "value": 20
                        },
                        {
                            "name": "\u6c5f\u897f\u7701",
                            "value": 25
                        },
                        {
                            "name": "\u798f\u5efa\u7701",
                            "value": 30
                        },
                        {
                            "name": "\u6d59\u6c5f\u7701",
                            "value": 90
                        },
                        {
                            "name": "\u6c5f\u82cf\u7701",
                            "value": 70
                        },
                        {
                            "name": "\u5b89\u5fbd\u7701",
                            "value": 50
                        }
                    ],
                    "roam": true,
                    "aspectScale": 0.75,
                    "nameProperty": "name",
                    "selectedMode": true,
                    "zoom": 1,
                    "zlevel": 0,
                    "z": 2,
                    "seriesLayoutBy": "column",
                    "datasetIndex": 0,
                    "mapValueCalculation": "sum",
                    "showLegendSymbol": false,
                    "emphasis": {}
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2018\u5e74\u6606\u66f2\u5404\u7701\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 100,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "map",
                    "name": "\u6606\u66f2\u7701\u70ed\u5ea6",
                    "label": {
                        "show": false,
                        "margin": 8
                    },
                    "map": "china",
                    "data": [
                        {
                            "name": "\u56db\u5ddd\u7701",
                            "value": 20
                        },
                        {
                            "name": "\u6c5f\u897f\u7701",
                            "value": 25
                        },
                        {
                            "name": "\u798f\u5efa\u7701",
                            "value": 30
                        },
                        {
                            "name": "\u6d59\u6c5f\u7701",
                            "value": 90
                        },
                        {
                            "name": "\u6c5f\u82cf\u7701",
                            "value": 70
                        },
                        {
                            "name": "\u5b89\u5fbd\u7701",
                            "value": 50
                        }
                    ],
                    "roam": true,
                    "aspectScale": 0.75,
                    "nameProperty": "name",
                    "selectedMode": true,
                    "zoom": 1,
                    "zlevel": 0,
                    "z": 2,
                    "seriesLayoutBy": "column",
                    "datasetIndex": 0,
                    "mapValueCalculation": "sum",
                    "showLegendSymbol": false,
                    "emphasis": {}
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2019\u5e74\u6606\u66f2\u5404\u7701\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 100,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        }
    ]
};
        chart_881150e3593c4f50a44fb9a40a2e74b4.setOption(option_881150e3593c4f50a44fb9a40a2e74b4);
    </script>
                <div id="9052c75a3a7f478e832a4a3b78762d53" class="chart-container" style="width:80vw; height:80vh; text-align:center; margin: auto"></div>
    <script>
            document.getElementById('9052c75a3a7f478e832a4a3b78762d53').style.width = document.getElementById('9052c75a3a7f478e832a4a3b78762d53').parentNode.clientWidth + 'px';
        var chart_9052c75a3a7f478e832a4a3b78762d53 = echarts.init(
            document.getElementById('9052c75a3a7f478e832a4a3b78762d53'), 'white', {renderer: 'canvas'});
        var option_9052c75a3a7f478e832a4a3b78762d53 = {
    "baseOption": {
        "series": [
            {
                "type": "effectScatter",
                "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                "coordinateSystem": "geo",
                "showEffectOn": "render",
                "rippleEffect": {
                    "show": true,
                    "brushType": "stroke",
                    "scale": 2.5,
                    "period": 4
                },
                "symbolSize": 5,
                "data": [
                    {
                        "name": "\u676d\u5dde",
                        "value": [
                            120.19,
                            30.26,
                            10000
                        ]
                    },
                    {
                        "name": "\u4e0a\u6d77",
                        "value": [
                            121.473701,
                            31.230416,
                            20000
                        ]
                    },
                    {
                        "name": "\u5357\u4eac",
                        "value": [
                            118.78,
                            32.04,
                            30000
                        ]
                    },
                    {
                        "name": "\u5317\u4eac",
                        "value": [
                            116.407526,
                            39.90403,
                            40000
                        ]
                    },
                    {
                        "name": "\u6210\u90fd",
                        "value": [
                            104.06,
                            30.67,
                            50000
                        ]
                    }
                ]
            }
        ],
        "timeline": {
            "axisType": "category",
            "currentIndex": 4,
            "orient": "horizontal",
            "autoPlay": false,
            "controlPosition": "left",
            "loop": false,
            "rewind": false,
            "show": true,
            "inverse": false,
            "symbol": "diamond",
            "playInterval": 1000,
            "bottom": "-5px",
            "progress": {},
            "data": [
                "2015\u5e74",
                "2016\u5e74",
                "2017\u5e74",
                "2018\u5e74",
                "2019\u5e74",
            ]
        },
        "geo": {
            "map": "china",
            "roam": true,
            "aspectScale": 0.75,
            "nameProperty": "name",
            "selectedMode": false,
            "label": {
                "show": false,
                "margin": 8
            },
            "emphasis": {}
        },
        "visualMap": {
            "show": true,
            "type": "piecewise",
            "min": 0,
            "max": 50000,
            "inRange": {
                "color": [
                    "#50a3ba",
                    "#eac763",
                    "#d94e5d"
                ]
            },
            "calculable": true,
            "inverse": false,
            "splitNumber": 5,
            "hoverLink": true,
            "orient": "vertical",
            "padding": 5,
            "showLabel": true,
            "itemWidth": 20,
            "itemHeight": 14,
            "borderWidth": 0
        },
        "legend": [
            {
                "data": [
                    "\u6606\u66f2\u5267\u9662\u70ed\u5ea6"
                ],
                "selected": {},
                "show": false,
                "padding": 5,
                "itemGap": 10,
                "itemWidth": 25,
                "itemHeight": 14,
                "backgroundColor": "transparent",
                "borderColor": "#ccc",
                "borderRadius": 0,
                "pageButtonItemGap": 5,
                "pageButtonPosition": "end",
                "pageFormatter": "{current}/{total}",
                "pageIconColor": "#2f4554",
                "pageIconInactiveColor": "#aaa",
                "pageIconSize": 15,
                "animationDurationUpdate": 800,
                "selector": false,
                "selectorPosition": "auto",
                "selectorItemGap": 7,
                "selectorButtonGap": 10
            }
        ]
    },
    "options": [
        {
            "series": [
                {
                    "type": "effectScatter",
                    "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                    "coordinateSystem": "geo",
                    "showEffectOn": "render",
                    "rippleEffect": {
                        "show": true,
                        "brushType": "stroke",
                        "scale": 2.5,
                        "period": 4
                    },
                    "symbolSize": 5,
                    "data": [
                        {
                            "name": "\u676d\u5dde",
                            "value": [
                                120.19,
                                30.26,
                                10000
                            ]
                        },
                        {
                            "name": "\u4e0a\u6d77",
                            "value": [
                                121.473701,
                                31.230416,
                                20000
                            ]
                        },
                        {
                            "name": "\u5357\u4eac",
                            "value": [
                                118.78,
                                32.04,
                                30000
                            ]
                        },
                        {
                            "name": "\u5317\u4eac",
                            "value": [
                                116.407526,
                                39.90403,
                                40000
                            ]
                        },
                        {
                            "name": "\u6210\u90fd",
                            "value": [
                                104.06,
                                30.67,
                                50000
                            ]
                        }
                    ]
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2015\u5e74\u6606\u66f2\u5404\u5267\u9662\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "formatter": function (params) {        return params.name + ' : ' + params.value[2];    },
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 50000,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "effectScatter",
                    "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                    "coordinateSystem": "geo",
                    "showEffectOn": "render",
                    "rippleEffect": {
                        "show": true,
                        "brushType": "stroke",
                        "scale": 2.5,
                        "period": 4
                    },
                    "symbolSize": 5,
                    "data": [
                        {
                            "name": "\u676d\u5dde",
                            "value": [
                                120.19,
                                30.26,
                                10000
                            ]
                        },
                        {
                            "name": "\u4e0a\u6d77",
                            "value": [
                                121.473701,
                                31.230416,
                                20000
                            ]
                        },
                        {
                            "name": "\u5357\u4eac",
                            "value": [
                                118.78,
                                32.04,
                                30000
                            ]
                        },
                        {
                            "name": "\u5317\u4eac",
                            "value": [
                                116.407526,
                                39.90403,
                                40000
                            ]
                        },
                        {
                            "name": "\u6210\u90fd",
                            "value": [
                                104.06,
                                30.67,
                                50000
                            ]
                        }
                    ]
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2016\u5e74\u6606\u66f2\u5404\u5267\u9662\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "formatter": function (params) {        return params.name + ' : ' + params.value[2];    },
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 50000,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "effectScatter",
                    "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                    "coordinateSystem": "geo",
                    "showEffectOn": "render",
                    "rippleEffect": {
                        "show": true,
                        "brushType": "stroke",
                        "scale": 2.5,
                        "period": 4
                    },
                    "symbolSize": 5,
                    "data": [
                        {
                            "name": "\u676d\u5dde",
                            "value": [
                                120.19,
                                30.26,
                                10000
                            ]
                        },
                        {
                            "name": "\u4e0a\u6d77",
                            "value": [
                                121.473701,
                                31.230416,
                                20000
                            ]
                        },
                        {
                            "name": "\u5357\u4eac",
                            "value": [
                                118.78,
                                32.04,
                                30000
                            ]
                        },
                        {
                            "name": "\u5317\u4eac",
                            "value": [
                                116.407526,
                                39.90403,
                                40000
                            ]
                        },
                        {
                            "name": "\u6210\u90fd",
                            "value": [
                                104.06,
                                30.67,
                                50000
                            ]
                        }
                    ]
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2017\u5e74\u6606\u66f2\u5404\u5267\u9662\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "formatter": function (params) {        return params.name + ' : ' + params.value[2];    },
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 50000,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "effectScatter",
                    "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                    "coordinateSystem": "geo",
                    "showEffectOn": "render",
                    "rippleEffect": {
                        "show": true,
                        "brushType": "stroke",
                        "scale": 2.5,
                        "period": 4
                    },
                    "symbolSize": 5,
                    "data": [
                        {
                            "name": "\u676d\u5dde",
                            "value": [
                                120.19,
                                30.26,
                                10000
                            ]
                        },
                        {
                            "name": "\u4e0a\u6d77",
                            "value": [
                                121.473701,
                                31.230416,
                                20000
                            ]
                        },
                        {
                            "name": "\u5357\u4eac",
                            "value": [
                                118.78,
                                32.04,
                                30000
                            ]
                        },
                        {
                            "name": "\u5317\u4eac",
                            "value": [
                                116.407526,
                                39.90403,
                                40000
                            ]
                        },
                        {
                            "name": "\u6210\u90fd",
                            "value": [
                                104.06,
                                30.67,
                                50000
                            ]
                        }
                    ]
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2018\u5e74\u6606\u66f2\u5404\u5267\u9662\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "formatter": function (params) {        return params.name + ' : ' + params.value[2];    },
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 50000,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        },
        {
            "series": [
                {
                    "type": "effectScatter",
                    "name": "\u6606\u66f2\u5267\u9662\u70ed\u5ea6",
                    "coordinateSystem": "geo",
                    "showEffectOn": "render",
                    "rippleEffect": {
                        "show": true,
                        "brushType": "stroke",
                        "scale": 2.5,
                        "period": 4
                    },
                    "symbolSize": 5,
                    "data": [
                        {
                            "name": "\u676d\u5dde",
                            "value": [
                                120.19,
                                30.26,
                                10000
                            ]
                        },
                        {
                            "name": "\u4e0a\u6d77",
                            "value": [
                                121.473701,
                                31.230416,
                                20000
                            ]
                        },
                        {
                            "name": "\u5357\u4eac",
                            "value": [
                                118.78,
                                32.04,
                                30000
                            ]
                        },
                        {
                            "name": "\u5317\u4eac",
                            "value": [
                                116.407526,
                                39.90403,
                                40000
                            ]
                        },
                        {
                            "name": "\u6210\u90fd",
                            "value": [
                                104.06,
                                30.67,
                                50000
                            ]
                        }
                    ]
                }
            ],
            "title": [
                {
                    "show": true,
                    "text": "2019\u5e74\u6606\u66f2\u5404\u5267\u9662\u70ed\u5ea6\u6570\u636e",
                    "target": "blank",
                    "subtext": "\u6570\u636e\u6765\u6e90:from web",
                    "subtarget": "blank",
                    "padding": 5,
                    "itemGap": 10,
                    "textAlign": "auto",
                    "textVerticalAlign": "auto",
                    "triggerEvent": false
                }
            ],
            "tooltip": {
                "show": true,
                "trigger": "item",
                "triggerOn": "mousemove|click",
                "axisPointer": {
                    "type": "line"
                },
                "showContent": true,
                "alwaysShowContent": false,
                "showDelay": 0,
                "hideDelay": 100,
                "enterable": false,
                "confine": false,
                "appendToBody": false,
                "transitionDuration": 0.4,
                "formatter": function (params) {        return params.name + ' : ' + params.value[2];    },
                "textStyle": {
                    "fontSize": 14
                },
                "borderWidth": 0,
                "padding": 5,
                "order": "seriesAsc"
            },
            "visualMap": {
                "show": true,
                "type": "piecewise",
                "min": 0,
                "max": 50000,
                "inRange": {
                    "color": [
                        "#50a3ba",
                        "#eac763",
                        "#d94e5d"
                    ]
                },
                "calculable": true,
                "inverse": false,
                "splitNumber": 5,
                "hoverLink": true,
                "orient": "vertical",
                "padding": 5,
                "showLabel": true,
                "itemWidth": 20,
                "itemHeight": 14,
                "borderWidth": 0
            },
            "color": [
                "#5470c6",
                "#91cc75",
                "#fac858",
                "#ee6666",
                "#73c0de",
                "#3ba272",
                "#fc8452",
                "#9a60b4",
                "#ea7ccc"
            ]
        }
    ]
};
        chart_9052c75a3a7f478e832a4a3b78762d53.setOption(option_9052c75a3a7f478e832a4a3b78762d53);
    </script>
    </div>

    <script>
    </script>
    <script>
        (function() {
            containers = document.getElementsByClassName("chart-container");
            if(containers.length > 0) {
                containers[0].style.display = "block";
            }
        })()

        function showChart(evt, chartID) {
            let containers = document.getElementsByClassName("chart-container");
            for (let i = 0; i < containers.length; i++) {
                containers[i].style.display = "none";
            }

            let tablinks = document.getElementsByClassName("tablinks");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].className = "tablinks";
            }

            document.getElementById(chartID).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>
</html>

HTML;
?>
