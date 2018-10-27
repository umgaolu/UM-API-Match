@extends('layouts.master')
@section('content')
<div class="container-fluid" role="main" style="font-size: 16px;">
<div class="row occupy align-items-center justify-content-center" style="display: none;">
<div class="col-md-5 col-xs-10 align-self-center">
  <div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h3>What would you like?</h3></div>
  <div class="card-body text-dark">
<form class="form-event" autocomplete="off">
  @csrf

  <div class="form-group row">
    <label for="canteen" class="col-sm-3 col-form-label">Languages</label>
    <div class="col-sm-9">
      <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="Cantonese" value="Cantonese">
      <label class="form-check-label" for="Cantonese">Cantonese</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="Mandarin" value="Mandarin">
        <label class="form-check-label" for="Mandarin">Mandarin</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="English" value="English">
        <label class="form-check-label" for="English">English</label>
      </div>
      </div>
  </div>
  <div class="form-group row">
    <label for="startDate" class="col-sm-3 col-form-label">Date From</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="startDate" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="startDate" value="{{date('Y-m-d')}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="endDate" class="col-sm-3 col-form-label">Date To</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="endDate" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="endDate" value="{{date('Y-m-d',time()+86400*7)}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="sp" class="col-sm-3 col-form-label">Smart Points</label>
    <div class="col-sm-4">
      <input class="form-control" type="text" id="sp" name="sp">
    </div>
  </div>
  <div class="form-group row align-items-center justify-content-center">
    <div class="col-6 align-self-center">
      <button class="btn btn-primary" type="submit" id="submitBtn"><span data-feather="check"></span>&nbsp;&nbsp;Go&nbsp;&nbsp;</button>
      <button class="btn btn-danger" type="reset"><span data-feather="rotate-ccw"></span>&nbsp;Reset</button>
    </div>
  </div>
</form>
  </div>
</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="/js/moment.js"></script>
<script src="/js/combodate.js"></script>
<script>
  $('#submitBtn').click(function(e){
    e.preventDefault();
    console.log($('#startDate').val());
  });
  $(function(){
    $('#startDate').combodate();
    $('#endDate').combodate();
    $('.nav-item').removeClass('active');
    $('.nav-event').addClass('active');
    console.log($(window).height());
    console.log($(document).height());
    $('.occupy').fadeIn(1000);
    $('.occupy').height($(window).height()-$('nav').outerHeight()*2);
    $(window).on('resize', function(){
      $('.occupy').height($(window).height()-$('nav').outerHeight()*2);
    });
  });
</script>
@endsection
