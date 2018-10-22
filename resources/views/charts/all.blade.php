@extends('charts.master')

@section('graphs')
<!-- <div id="chart" style="width: 100%; min-height: 800px"></div> -->
<div class="col-md-6 col-sm-12 pt-3"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart1"></div></div></div></div>
<div class="col-md-6 col-sm-12 pt-3"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart2"></div></div></div></div>
<div class="col-md-6 col-sm-12 pt-3"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart3"></div></div></div></div>
<div class="col-md-6 col-sm-12 pt-3"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart4"></div></div></div></div>
@endsection

@section('scripts')
<script src="/js/chart.config.js"></script>
<script>
    $(function(){
        // Handler for .ready() called.
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: '/charts',
            dataType: 'json',
            type: 'get',
            success: function(data){
                var days=data.days;
                var locations=data.locations;
                var rcs=data.rcs;
                var mealType=data.mealType;
                var lineData=data.lineData;
                var barData=data.barData;
                var pieData=data.pieData;
                var bubbleData=data.bubbleData;

                var dom1=document.getElementById("chart1");
                var chart1=echarts.init(dom1, 'dark');
                var lineLegendData=locations;
                var lineXAxisData=days;
                var lineSeries=[];
                for(const[key,value] of Object.entries(lineData)){
                    lineSeries.push(setSeriesBase({chartType:'line',seriesData:value,stack:'Total',seriesName:key}));
                }
                var lineOption=setBaseOption({chartType:'line',legendData:lineLegendData,xAxisData:lineXAxisData,series:lineSeries});
                if (lineOption && typeof lineOption==="object"){
                    chart1.setOption(lineOption, true);
                }

                var dom2 = document.getElementById("chart2");
                var chart2 = echarts.init(dom2, 'dark');
                var barXAxisData=days;
                var barSeries=[];
                for(const[key,value] of Object.entries(barData)){
                    barSeries.push(setSeriesBase({chartType:'bar',seriesData:value,seriesName:key}));
                }
                var barOption=setBaseOption({chartType:'bar',legendData:mealType,xAxisData:barXAxisData,series:barSeries});
                if (barOption && typeof barOption==="object"){
                    chart2.setOption(barOption, true);
                }

                var dom3=document.getElementById("chart3");
                var chart3=echarts.init(dom3, 'dark');
                var pieSeries=[setSeriesBase({chartType:'pie',seriesData:pieData,seriesName:'Consumtion Location'})];
                var pieOption=setBaseOption({chartType:'pie',titleText:'Where Meal is Consumed?',legendData:locations,series:pieSeries});
                if (pieOption && typeof pieOption === "object") {
                    chart3.setOption(pieOption, true);
                }

                var dom4 = document.getElementById("chart4");
                var chart4 = echarts.init(dom4, 'dark');
                var bubbleFormatterFunction=function(param){return (rcs[param.data[0]]+'@'+locations[param.data[1]]+': '+param.data[2]);};
                var bubbleSymbolSizeFunction=function(data){return Math.sqrt(data[2])*10;}
                var bubbleSeries=[setSeriesBase({chartType:'bubble',seriesData:bubbleData,formatterFunction:bubbleFormatterFunction,symbolSizeFunction:bubbleSymbolSizeFunction})];
                var bubbleOption=setBaseOption({chartType:'bubble',titleText:'RC Member v.s. RC Canteen',xAxisData:rcs,xAxisName:'RC Member',yAxisData:locations,yAxisName:'RC Canteen',series:bubbleSeries});
                if (bubbleOption && typeof bubbleOption === "object") {
                    chart4.setOption(bubbleOption, true);
                }
                $(window).on('resize', function(){
                    if(chart1 != null && chart1 != undefined){
                        chart1.resize();
                    }
                    if(chart2 != null && chart2 != undefined){
                        chart2.resize();
                    }
                    if(chart3 != null && chart3 != undefined){
                        chart3.resize();
                    }
                    if(chart4 != null && chart4 != undefined){
                        chart4.resize();
                    }
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
