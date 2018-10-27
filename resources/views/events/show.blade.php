@extends('layouts.master')
@section('content')
<div class="container-fluid" role="main" style="font-size: 16px;">
  <table class="table show-events" style="display:none;">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Event Date From</th>
      <th scope="col">Event Date To</th>
      <th scope="col">Event Title</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key=>$row)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$row['dateFrom']}}</td>
      <td>{{$row['dateTo']}}</td>
      <td>{{$row['title']}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection

@section('scripts')
<script>
$(function(){
    $('.nav-item').removeClass('active');
    $('.nav-event').addClass('active');
    $('.show-events').fadeIn(1000);
  });
</script>
@endsection
