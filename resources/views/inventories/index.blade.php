@extends('layouts.master')

@section('controls')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Dashboard</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary">Share</button>
    <button class="btn btn-sm btn-outline-secondary">Export</button>
  </div>
  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
    <span data-feather="calendar">
    This week
  </button>
</div>
</div>
@endsection

<!-- @section('data')
<h2>Data</h2>
<div class="table-responsive">
<table class="table table-striped table-sm">
  <thead>
    <tr>
		@foreach($fields as $field)
		      <th>{{ucwords($field)}}</th>
		@endforeach
    </tr>
  </thead>
  <tbody>
  	@foreach($inventories as $inventory)
	    <tr>
	      <td>{{$inventory->item}}</td>
	      <td>{{$inventory->qty}}</td>
	      <td>{{$inventory->status}}</td>
	      <td>{{json_encode($inventory->size)}}</td>
	      <td>{{json_encode($inventory->tags)}}</td>
	    </tr>
	@endforeach
  </tbody>
</table>
</div>
@endsection
 -->
@section('graphs')
<!-- <div id="chart" style="width: 100%; min-height: 800px"></div> -->
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 350px" id="chart1"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 350px" id="chart2"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 350px" id="chart3"></div></div></div></div>
<div class="col-md-6 col-sm-12"><div class="card"><div class="card-body"><div style="width: 100%; min-height: 350px" id="chart4"></div></div></div></div>
<script src="/js/chart.data.js"></script>
<script>
  /*
  var dom = document.getElementById("chart");
  var myChart = echarts.init(dom, 'dark');
  if (option && typeof option === "object") {
      myChart.setOption(option, true);
  }
  */
  // $(window).on('resize', function(){
  //     if(myChart != null && myChart != undefined){
  //         myChart.resize();
  //     }
  // });
  var dom1 = document.getElementById("chart1");
  var chart1 = echarts.init(dom1, 'vintage');
  if (lineOption && typeof lineOption === "object") {
      chart1.setOption(lineOption, true);
  }
  var dom2 = document.getElementById("chart2");
  var chart2 = echarts.init(dom2, 'vintage');
  if (barOption && typeof barOption === "object") {
      chart2.setOption(barOption, true);
  }
  var dom3 = document.getElementById("chart3");
  var chart3 = echarts.init(dom3, 'vintage');
  if (pieOption && typeof pieOption === "object") {
      chart3.setOption(pieOption, true);
  }
  var dom4 = document.getElementById("chart4");
  var chart4 = echarts.init(dom4, 'vintage');
  if (scatterOption && typeof scatterOption === "object") {
      chart4.setOption(scatterOption, true);
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
// var chBar = document.getElementById("chart1");
// new Chart(chBar, {
//     type: 'bar',
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255,99,132,1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 }
//             }]
//         }
//     }
// });

// var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

// /* large line chart */
// var chLine = document.getElementById("chart2");
// var chartData = {
//   labels: ["S", "M", "T", "W", "T", "F", "S"],
//   datasets: [{
//     data: [589, 445, 483, 503, 689, 692, 634],
//     backgroundColor: 'transparent',
//     borderColor: colors[0],
//     borderWidth: 4,
//     pointBackgroundColor: colors[0]
//   },
//   {
//     data: [639, 465, 493, 478, 589, 632, 674],
//     backgroundColor: colors[3],
//     borderColor: colors[1],
//     borderWidth: 4,
//     pointBackgroundColor: colors[1]
//   }]
// };

// if (chLine) {
//     new Chart(chLine, {
//         type: 'line',
//         data: chartData,
//         options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: false
//                 }
//             }]
//         },
//         legend: {
//             display: false
//         }
//       }
//     });
// }
// var donutOptions = {
//     cutoutPercentage: 85,
//     legend: {position:'bottom',
//         labels:{pointStyle:'circle',
//         usePointStyle:true}
//     }
// };
// var chDonutData1 = {
//     labels: ['Bootstrap', 'Popper', 'Other'],
//     datasets: [
//         {
//             backgroundColor: colors.slice(0,3),
//             borderWidth: 0,
//             data: [74, 11, 40]
//         }
//     ]
// };
// var chDonut1 = document.getElementById("chart3");
// if (chDonut1) {
//     new Chart(chDonut1, {
//         type: 'pie',
//         data: chDonutData1,
//         options: donutOptions
//     });
// }
// var chPolarData = {
//     datasets: [{
//         backgroundColor: ['#c3e6cb','#dc3545','#6c757d'],
//         data: [10, 20, 30]
//     }],

//     // These labels appear in the legend and in the tooltips when hovering different arcs
//     labels: [
//         'Red',
//         'Yellow',
//         'Blue'
//     ]
// };
// var polarOptions = {
//   startAngle: -0.5 * Math.PI,
//   animateRotate: true,
//   animateScale: true
// };
// var chPolar = document.getElementById("chart4");
// if (chPolar) {
//     new Chart(chPolar, {
//         data: chPolarData,
//         type: 'polarArea',
//         options: polarOptions
//     });
// }
</script>
@endsection
