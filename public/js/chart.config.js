var colorPalette=['#dd6b66','#759aa0','#e69d87','#8dc1a9','#ea7e53','#eedd78','#73a373','#73b9bc','#7289ab', '#91ca8c','#f49f42'];

function setSeriesBase(args){
    // define basic options of each type of series
    var lineSeriesBase={type:'line'};
    var barSeriesBase={
        type:'bar',
        itemStyle:{
            normal:{
                // color:function(params){return colorPalette[params.dataIndex]},
                // label:{show:true,position:'top',formatter:'{a}\n{c}'}
            }
        }
        //, name:''
    };
    var pieSeriesBase={
        type:'pie',
        radius:'55%',
        center:['50%','60%'],
        itemStyle:{
            emphasis:{shadowBlur:10,shadowOffsetX:0,shadowColor:'rgba(0, 0, 0, 0.5)'}
        }
    }
    var bubbleSerieseBase={
        // symbolOffset:[],
        // symbolSize:function(data){return Math.sqrt(data[2]);},
        symbolSize:function(){},
        label:{
            emphasis:{
                show:true,
                formatter:function(){},
                position: 'top'
            }
        },
        itemStyle:{
            normal:{
                shadowBlur:10,
                shadowColor:'rgba(120, 36, 50, 0.5)',
                shadowOffsetY:5,
                color:function(params){return colorPalette[colorPalette.length-1-params.dataIndex%colorPalette.length]},
            }
        },
        type:'scatter'
    };
    switch(args.chartType){
        case 'line':
            var clone=Object.assign({}, lineSeriesBase);
            break;
        case 'bar':
            var clone=Object.assign({}, barSeriesBase);
            break;
        case 'pie':
            var clone=Object.assign({}, pieSeriesBase);
            break;
        case 'bubble':
            var clone=Object.assign({}, bubbleSerieseBase);
            break;
    }
    if('seriesData' in args) clone['data']=args.seriesData;
    if('seriesName' in args) clone['name']=args.seriesName;
    if('stack' in args) clone['stack']=args.stack;
    if('symbolSizeFunction' in args) clone['symbolSize']=args.symbolSizeFunction;
    if('formatterFunction' in args) clone['label']['emphasis']['formatter']=args.formatterFunction;
    if('symbolOffset' in args) clone['symbolOffset']=args.symbolOffset;
    return clone;
}
function setBaseOption(args){
    // define basic layout for each type of chart
    var lineBaseOption={
        // placeholder is mandatory if nested
        title:{text:''},
        tooltip:{trigger: 'axis'},
        grid:{left:'3%',right:'4%',bottom:'3%',containLabel:true},
        legend:{data:[]},
        xAxis:{type:'category',boundaryGap:false
        // ,data:[]
        },
        yAxis:{type:'value'}
        // ,series:[]
    };
    var barBaseOption={
        tooltip:{trigger:'item',formatter:"{b} <br/>{a} : {c}"},
        xAxis:{type:'category'
        // ,data:[]
        },
        yAxis:{type:'value'},
        legend:{data:[]},
        // ,series:[]
    };
    var pieBaseOption={
        title:{text:'',x:'center'},
        tooltip:{trigger:'item',formatter:"{a} <br/>{b} : {c} ({d}%)"},
        legend:{orient:'vertical',left:'left'
        // ,data:[]
        }
        // ,series:[]
    };
    var bubbleBaseOption={
        title:{x:'center',text:''},
        legend:{right:10,data:[]},
        xAxis:{
            type:'category',
            nameLocation:'middle',
            nameTextStyle:{align:'center',padding:10}
            // ,data:[]
        },
        yAxis: {type:'category'
        // ,data:[]
    }
    // ,series:[]
    };
    switch(args.chartType){
        case 'line':
            var clone=Object.assign({}, lineBaseOption);
            break;
        case 'bar':
            var clone=Object.assign({}, barBaseOption);
            break;
        case 'pie':
            var clone=Object.assign({}, pieBaseOption);
            break;
        case 'bubble':
            var clone=Object.assign({}, bubbleBaseOption);
            break;
    }
    if('titleText' in args) clone['title']['text']=args.titleText;
    if('legendData' in args) clone['legend']['data']=args.legendData;
    if('xAxisData' in args) clone['xAxis']['data']=args.xAxisData;
    if('xAxisName' in args) clone['xAxis']['name']=args.xAxisName;
    if('yAxisData' in args) clone['yAxis']['data']=args.yAxisData;
    if('yAxisName' in args) clone['yAxis']['name']=args.yAxisName;
    if('series' in args) clone['series']=args.series;
    return clone;
}
// var lineLegendData=['邮件营销','联盟广告','视频广告','直接访问','搜索引擎'];
// var lineXAxisData=['周一','周二','周三','周四','周五','周六','周日'];
// var lineData=[[120, 132, 101, 134, 90, 230, 210],[220, 182, 191, 234, 290, 330, 310],[150, 232, 201, 154, 190, 330, 410],[320, 332, 301, 334, 390, 330, 320],[820, 932, 901, 934, 1290, 1330, 1320]]
// var lineSeries=[];
// for(i in lineData){
//     lineSeries.push(setSeriesBase({chartType:'line',seriesData:lineData[i],stack:'总量',seriesName:lineLegendData[i]}));
// }
// var lineOption=setBaseOption({chartType:'line',titleText:'折线图堆叠',legendData:lineLegendData,xAxisData:lineXAxisData,series:lineSeries});

// var barXAxisData=['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
// var barSeries=[setSeriesBase({chartType:'bar',seriesData:[120, 200, 150, 80, 70, 110, 130]})];
// var barOption=setBaseOption({chartType:'bar',xAxisData:barXAxisData,series:barSeries});
