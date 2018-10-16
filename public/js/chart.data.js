var colorPalette = ['#dd6b66','#759aa0','#e69d87','#8dc1a9','#ea7e53','#eedd78','#73a373','#73b9bc','#7289ab', '#91ca8c','#f49f42'];
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
        type: 'bar',
        itemStyle: {
            normal: {
                color: function(params) {
                    // var colorList = ['#2eddc1', '#FCCE10', '#E87C25', '#27727B','#9efdc6', '#f27C99', '#a27C99', '#27727B' ];
                    return colorPalette[params.dataIndex]
                },
                label: {
                    show: true,
                    position: 'top',
                    formatter: '{b}\n{c}'
                }
            }
        },
    }]
};

pieOption = {
    title : {
        text: 'Where Meal is Consumed?',
        // subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        // data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
        data: locations
    },
    series : [
        {
            name: 'Consumtion Location',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data: pieData,
            // data:[
            //     {value:335, name:'直接访问'},
            //     {value:310, name:'邮件营销'},
            //     {value:234, name:'联盟广告'},
            //     {value:135, name:'视频广告'},
            //     {value:1548, name:'搜索引擎'}
            // ],
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

bubbleOption = {
    title: {
        text: 'RC Member v.s. RC Canteen',
        x:'center'
    },
    xAxis: {
        type: 'category',
        data: rcs,
        name: 'RC Member',
        nameLocation: 'middle',
        nameTextStyle: {
            align: 'center',
            padding: 10
        }
    },
    yAxis: {
        type: 'category',
        data: locations,
        name: 'RC Canteen'
    },
    series: [{
        symbolSize: function (data) {
            return Math.sqrt(data[2])*10;
        },
        label: {
            emphasis: {
                show: true,
                formatter: function (param) {
                    return (rcs[param.data[0]]+'@'+locations[param.data[1]]+': '+param.data[2]);
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(120, 36, 50, 0.5)',
                shadowOffsetY: 5,
                color: function(params) {
                    // var colorList = ['#2eddc1', '#FCCE10', '#E87C25', '#27727B','#9efdc6', '#f27C99', '#a27C99', '#27727B' ];
                    // return colorList[params.dataIndex%colorList.length]
                    return colorPalette[colorPalette.length - 1 - params.dataIndex%colorPalette.length]
                },
            }
        },
        data: bubbleData,
        type: 'scatter'
    }]
};
