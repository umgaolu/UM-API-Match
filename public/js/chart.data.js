lineOption = {
    title: {
        text: '折线图堆叠'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'邮件营销',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'联盟广告',
            type:'line',
            stack: '总量',
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'视频广告',
            type:'line',
            stack: '总量',
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'直接访问',
            type:'line',
            stack: '总量',
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'搜索引擎',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};

barOption = {
    xAxis: {
        type: 'category',
        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [120, 200, 150, 80, 70, 110, 130],
        type: 'bar'
    }]
};

pieOption = {
    title : {
        text: '某站点用户访问来源',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

var scatterData = [
    [[28604,77,17096869,'Australia',1990],[31163,77.4,27662440,'Canada',1990],[1516,68,1154605773,'China',1990],[13670,74.7,10582082,'Cuba',1990],[28599,75,4986705,'Finland',1990],[29476,77.1,56943299,'France',1990],[31476,75.4,78958237,'Germany',1990],[28666,78.1,254830,'Iceland',1990],[1777,57.7,870601776,'India',1990],[29550,79.1,122249285,'Japan',1990],[2076,67.9,20194354,'North Korea',1990],[12087,72,42972254,'South Korea',1990],[24021,75.4,3397534,'New Zealand',1990],[43296,76.8,4240375,'Norway',1990],[10088,70.8,38195258,'Poland',1990],[19349,69.6,147568552,'Russia',1990],[10670,67.3,53994605,'Turkey',1990],[26424,75.7,57110117,'United Kingdom',1990],[37062,75.4,252847810,'United States',1990]],
    [[44056,81.8,23968973,'Australia',2015],[43294,81.7,35939927,'Canada',2015],[13334,76.9,1376048943,'China',2015],[21291,78.5,11389562,'Cuba',2015],[38923,80.8,5503457,'Finland',2015],[37599,81.9,64395345,'France',2015],[44053,81.1,80688545,'Germany',2015],[42182,82.8,329425,'Iceland',2015],[5903,66.8,1311050527,'India',2015],[36162,83.5,126573481,'Japan',2015],[1390,71.4,25155317,'North Korea',2015],[34644,80.7,50293439,'South Korea',2015],[34186,80.6,4528526,'New Zealand',2015],[64304,81.6,5210967,'Norway',2015],[24787,77.3,38611794,'Poland',2015],[23038,73.13,143456918,'Russia',2015],[19360,76.5,78665830,'Turkey',2015],[38225,81.4,64715810,'United Kingdom',2015],[53354,79.1,321773631,'United States',2015]]
];

scatterOption = {
    backgroundColor: new echarts.graphic.RadialGradient(0.3, 0.3, 0.8, [{
        offset: 0,
        color: '#f7f8fa'
    }, {
        offset: 1,
        color: '#cdd0d5'
    }]),
    title: {
        text: '1990 与 2015 年各国家人均寿命与 GDP'
    },
    legend: {
        right: 10,
        scatterData: ['1990', '2015']
    },
    xAxis: {
        splitLine: {
            lineStyle: {
                type: 'dashed'
            }
        }
    },
    yAxis: {
        splitLine: {
            lineStyle: {
                type: 'dashed'
            }
        },
        scale: true
    },
    series: [{
        name: '1990',
        scatterData: scatterData[0],
        type: 'scatter',
        symbolSize: function (scatterData) {
            return Math.sqrt(scatterData[2]) / 5e2;
        },
        label: {
            emphasis: {
                show: true,
                formatter: function (param) {
                    return param.scatterData[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(120, 36, 50, 0.5)',
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: 'rgb(251, 118, 123)'
                }, {
                    offset: 1,
                    color: 'rgb(204, 46, 72)'
                }])
            }
        }
    }, {
        name: '2015',
        scatterData: scatterData[1],
        type: 'scatter',
        symbolSize: function (scatterData) {
            return Math.sqrt(scatterData[2]) / 5e2;
        },
        label: {
            emphasis: {
                show: true,
                formatter: function (param) {
                    return param.scatterData[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(25, 100, 150, 0.5)',
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: 'rgb(129, 227, 238)'
                }, {
                    offset: 1,
                    color: 'rgb(25, 183, 207)'
                }])
            }
        }
    }]
};
// option = null;

// var builderJson = {
//   "all": 10887,
//   "charts": {
//     "map": 3237,
//     "lines": 2164,
//     "bar": 7561,
//     "line": 7778,
//     "pie": 7355,
//     "scatter": 2405,
//     "candlestick": 1842,
//     "radar": 2090,
//     "heatmap": 1762,
//     "treemap": 1593,
//     "graph": 2060,
//     "boxplot": 1537,
//     "parallel": 1908,
//     "gauge": 2107,
//     "funnel": 1692,
//     "sankey": 1568
//   },
//   "components": {
//     "geo": 2788,
//     "title": 9575,
//     "legend": 9400,
//     "tooltip": 9466,
//     "grid": 9266,
//     "markPoint": 3419,
//     "markLine": 2984,
//     "timeline": 2739,
//     "dataZoom": 2744,
//     "visualMap": 2466,
//     "toolbox": 3034,
//     "polar": 1945
//   },
//   "ie": 9743
// };

// var downloadJson = {
//   "echarts.min.js": 17365,
//   "echarts.simple.min.js": 4079,
//   "echarts.common.min.js": 6929,
//   "echarts.js": 14890
// };

// var themeJson = {
//   "dark.js": 1594,
//   "infographic.js": 925,
//   "shine.js": 1608,
//   "roma.js": 721,
//   "macarons.js": 2179,
//   "vintage.js": 1982
// };

// option = {
//     tooltip: {},
//     title: [{
//         text: '在线构建',
//         subtext: '总计 ' + builderJson.all,
//         x: '25%',
//         textAlign: 'center'
//     }, {
//         text: '各版本下载',
//         subtext: '总计 ' + Object.keys(downloadJson).reduce(function (all, key) {
//             return all + downloadJson[key];
//         }, 0),
//         x: '75%',
//         textAlign: 'center'
//     }, {
//         text: '主题下载',
//         subtext: '总计 ' + Object.keys(themeJson).reduce(function (all, key) {
//             return all + themeJson[key];
//         }, 0),
//         x: '75%',
//         y: '50%',
//         textAlign: 'center'
//     }],
//     grid: [{
//         top: 50,
//         width: '50%',
//         bottom: '45%',
//         left: 10,
//         containLabel: true
//     }, {
//         top: '55%',
//         width: '50%',
//         bottom: 0,
//         left: 10,
//         containLabel: true
//     }],
//     xAxis: [{
//         type: 'value',
//         max: builderJson.all,
//         splitLine: {
//             show: false
//         }
//     }, {
//         type: 'value',
//         max: builderJson.all,
//         gridIndex: 1,
//         splitLine: {
//             show: false
//         }
//     }],
//     yAxis: [{
//         type: 'category',
//         data: Object.keys(builderJson.charts),
//         axisLabel: {
//             interval: 0,
//             rotate: 30
//         },
//         splitLine: {
//             show: false
//         }
//     }, {
//         gridIndex: 1,
//         type: 'category',
//         data: Object.keys(builderJson.components),
//         axisLabel: {
//             interval: 0,
//             rotate: 30
//         },
//         splitLine: {
//             show: false
//         }
//     }],
//     series: [{
//         type: 'bar',
//         stack: 'chart',
//         z: 3,
//         label: {
//             normal: {
//                 position: 'right',
//                 show: true
//             }
//         },
//         data: Object.keys(builderJson.charts).map(function (key) {
//             return builderJson.charts[key];
//         })
//     }, {
//         type: 'bar',
//         stack: 'chart',
//         silent: true,
//         itemStyle: {
//             normal: {
//                 color: '#eee'
//             }
//         },
//         data: Object.keys(builderJson.charts).map(function (key) {
//             return builderJson.all - builderJson.charts[key];
//         })
//     }, {
//         type: 'bar',
//         stack: 'component',
//         xAxisIndex: 1,
//         yAxisIndex: 1,
//         z: 3,
//         label: {
//             normal: {
//                 position: 'right',
//                 show: true
//             }
//         },
//         data: Object.keys(builderJson.components).map(function (key) {
//             return builderJson.components[key];
//         })
//     }, {
//         type: 'bar',
//         stack: 'component',
//         silent: true,
//         xAxisIndex: 1,
//         yAxisIndex: 1,
//         itemStyle: {
//             normal: {
//                 color: '#eee'
//             }
//         },
//         data: Object.keys(builderJson.components).map(function (key) {
//             return builderJson.all - builderJson.components[key];
//         })
//     }, {
//         type: 'pie',
//         radius: [0, '30%'],
//         center: ['75%', '25%'],
//         data: Object.keys(downloadJson).map(function (key) {
//             return {
//                 name: key.replace('.js', ''),
//                 value: downloadJson[key]
//             }
//         })
//     }, {
//         type: 'pie',
//         radius: [0, '30%'],
//         center: ['75%', '75%'],
//         data: Object.keys(themeJson).map(function (key) {
//             return {
//                 name: key.replace('.js', ''),
//                 value: themeJson[key]
//             }
//         })
//     }]
// };
