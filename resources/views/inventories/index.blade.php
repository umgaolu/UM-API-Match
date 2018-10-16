@extends('layouts.master')

<!-- @section('data')
<h2>Data</h2>
<div class="table-responsive">
<table class="table table-striped table-sm">
  <thead>
    <tr>
		{{--@foreach($fields as $field)--}}
		      <th>{{--ucwords($field)--}}</th>
		{{--@endforeach--}}
    </tr>
  </thead>
  <tbody>
  	{{--@foreach($inventories as $inventory)--}}
	    <tr>
	      <td>{{--$inventory->item--}}</td>
	      <td>{{--$inventory->qty--}}</td>
	      <td>{{--$inventory->status--}}</td>
	      <td>{{--json_encode($inventory->size)--}}</td>
	      <td>{{--json_encode($inventory->tags)--}}</td>
	    </tr>
	{{--@endforeach--}}
  </tbody>
</table>
</div>
@endsection -->

@section('graphs')
<!-- <div id="chart" style="width: 100%; min-height: 800px"></div> -->
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart1"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart2"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart3"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 380px" id="chart4"></div></div></div></div>
<script src="/js/chart.data.js"></script>
<script>
  var dom1 = document.getElementById("chart1");
  var chart1 = echarts.init(dom1, 'dark');
  if (lineOption && typeof lineOption === "object") {
      chart1.setOption(lineOption, true);
  }
  var dom2 = document.getElementById("chart2");
  var chart2 = echarts.init(dom2, 'dark');
  if (barOption && typeof barOption === "object") {
      chart2.setOption(barOption, true);
  }
  var dom3 = document.getElementById("chart3");
  var chart3 = echarts.init(dom3, 'dark');
  if (pieOption && typeof pieOption === "object") {
      chart3.setOption(pieOption, true);
  }
  var dom4 = document.getElementById("chart4");
  var chart4 = echarts.init(dom4, 'dark');
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
</script>
@endsection
