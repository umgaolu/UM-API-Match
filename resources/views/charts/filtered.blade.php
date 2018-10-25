@extends('charts.master')

@section('content')
<div class="row">
  @for($i=1;$i< 5;$i++)
  <div class="col-lg-6 col-md-12 px-0">
    <div class="card">
      <div style="width:100%;min-height:380px" id="chart{{$i}}" class="chart"></div>
    </div>
  </div>
  @endfor
</div>
@endsection

@section('scripts')
<script src="/js/chart.config.js"></script>
<script>
  $(function(){
    function setChartHeight(){
      if($(window).height()<768&&$(window).height()<=$(window).width()){
        // small screen & landscape
        $('.chart').height($(window).height()-$('nav').outerHeight());
      }else{
        $('.chart').height(($(window).height()-$('nav').outerHeight())/2-3);
      }
    }
    setChartHeight();
    // Handler for .ready() called.
    var dom1=document.getElementById("chart1");
    var chart1=echarts.init(dom1, 'dark');
    chart1.showLoading();
    var dom2=document.getElementById("chart2");
    var chart2=echarts.init(dom2, 'dark');
    chart2.showLoading();
    var dom3=document.getElementById("chart3");
    var chart3=echarts.init(dom3, 'dark');
    chart3.showLoading();
    var dom4=document.getElementById("chart4");
    var chart4=echarts.init(dom4, 'dark');
    chart4.showLoading();
    $(window).on('resize', function(){
      setChartHeight();
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
    $.ajaxSetup({
      headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    var canteens={!!htmlspecialchars_decode($canteens)!!};
    var rcs={!!htmlspecialchars_decode($rcs)!!};
    var meals={!!htmlspecialchars_decode($meals)!!};
    var startDate='{{$startDate}}';
    var endDate='{{$endDate}}';
    $.ajax({
      url:'/line',
      dataType:'json',
      type:'post',
      data:{'canteens':canteens,'startDate':startDate,'endDate':endDate},
      {{--data:['canteens':{{session('canteens')}},'startDate':{{session('startDate')}},'endDate':{{session('endDate')}}],--}}
      success: function(data){
        var lineSeries=[];
        for(const[key,value] of Object.entries(data.lineData)){
          lineSeries.push(setSeriesBase({chartType:'line',seriesData:value,stack:'Total',seriesName:key}));
        }
        var lineOption=setBaseOption({chartType:'line',legendData:data.lineLegend,xAxisData:data.lineXAxis,series:lineSeries});
        if (lineOption && typeof lineOption==="object"){
          chart1.setOption(lineOption, true);
          chart1.hideLoading();
        }
      },
      error: function(data){console.log('Error from line:',data);}
    });
    $.ajax({
      url:'/bar',
      dataType:'json',
      type:'post',
      data:{'meals':meals,'startDate':startDate,'endDate':endDate},
      {{--data:['meals':{{session('meals')}},'startDate':{{session('startDate')}},'endDate':{{session('endDate')}}],--}}
      success: function(data){
        var barSeries=[];
        for(const[key,value] of Object.entries(data.barData)){
          barSeries.push(setSeriesBase({chartType:'bar',seriesData:value,seriesName:key}));
        }
        var barOption=setBaseOption({chartType:'bar',legendData:data.barLegend,xAxisData:data.barXAxis,series:barSeries});
        if (barOption && typeof barOption==="object"){
          chart2.setOption(barOption, true);
          chart2.hideLoading();
        }
      },
      error: function(data){console.log('Error from bar:',data);}
    });
    $.ajax({
      url:'/pie',
      dataType:'json',
      type:'post',
      data:{'canteens':canteens,'startDate':startDate,'endDate':endDate},
      {{--data:['meals':{{session('canteens')}},'startDate':{{session('startDate')}},'endDate':{{session('endDate')}}],--}}
      success: function(data){
        var pieSeries=[setSeriesBase({chartType:'pie',seriesData:data.pieData,seriesName:'Consumtion Location'})];
        var pieOption=setBaseOption({chartType:'pie',titleText:'Where Meal is Consumed?',legendData:data.pieLegend,series:pieSeries});
        if(pieOption && typeof pieOption === "object"){
          chart3.setOption(pieOption, true);
          chart3.hideLoading();
        }
      },
      error: function(data){console.log('Error from pie:',data);}
    });
    $.ajax({
      url:'/bubble',
      dataType:'json',
      type:'post',
      data:{'meals':meals,'canteens':canteens,'rcs':rcs,'startDate':startDate,'endDate':endDate},
      {{--data:['meals':{{session('meals')}},'canteens':{{session('canteens')}},'rcs':{{session('rcs')}},'startDate':{{session('startDate')}},'endDate':{{session('endDate')}}],--}}
      success: function(data){
        var bubbleFormatterFunction=function(param){return (data.bubbleXAxis[param.data[0]]+'@'+data.bubbleYAxis[param.data[1]]+': '+param.data[2]);};
        var bubbleSymbolSizeFunction=function(data){return Math.sqrt(data[2])/2;}
        var bubbleSeries=[setSeriesBase({chartType:'bubble',seriesData:data.bubbleData,formatterFunction:bubbleFormatterFunction,symbolSizeFunction:bubbleSymbolSizeFunction})];
        var bubbleOption=setBaseOption({chartType:'bubble',titleText:'RC Member v.s. RC Canteen',xAxisData:data.bubbleXAxis,xAxisName:'RC Member',yAxisData:data.bubbleYAxis,yAxisName:'RC Canteen',series:bubbleSeries});
        if(bubbleOption && typeof bubbleOption === "object"){
          chart4.setOption(bubbleOption, true);
          chart4.hideLoading();
        }
      },
      error: function(data){console.log('Error from bubble:', data);}
    });
  });
</script>
@endsection
