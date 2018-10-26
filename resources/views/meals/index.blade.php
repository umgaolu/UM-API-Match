@extends('layouts.master')
@section('content')
<div class="container-fluid" role="main">
<div class="row occupy" style="display:none;"><div class="col-12 align-self-center">
  <div class="row align-items-center justify-content-center">
    <div class="col-12 align-self-center">
      <div class="row align-items-center justify-content-center">
        <div class="col-8 col-md-6 align-self-center">
          <div class="py-1 text-justify">
            <h4>Student in Canteens</h4>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($rcs as $rc)
        <div class="col-6 pt-3 d-flex d-md-none">
          <div class="card text-center">
            <div class="card-body">
              <div style="width:100%">
                    <img src="/RCLogo/{{$rc}}.png" alt="" class="card-img-top"></div>
            </div>
            <div class="card-footer">
              <small class="text-muted">smsmsmsmssmsm</small>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="row justify-content-center">
        @foreach(array_slice($rcs,0,5) as $rc)
        <div class="col-md-2 pt-3 d-none d-md-flex">
          <div class="card text-center">
            <div class="card-body">
              <div style="width:100%">
                    <img src="/RCLogo/{{$rc}}.png" alt="" class="card-img-top"></div>
            </div>
            <div class="card-footer">
              <small class="text-muted">smsmsmsmssmsm</small>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="row justify-content-center">
        @foreach(array_slice($rcs,5) as $rc)
        <div class="col-md-2 pt-3 d-none d-md-flex">
          <div class="card text-center">
            <div class="card-body">
              <div style="width:100%">
                    <img src="/RCLogo/{{$rc}}.png" alt="" class="card-img-top"></div>
            </div>
            <div class="card-footer">
              <small class="text-muted">smsmsmsmssmsm</small>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="row align-items-center justify-content-center"><div class="col-8 col-md-6 mb-1"><hr></div></div>
  <div class="row align-items-center justify-content-center">
    <div class="col-sm-8 align-self-center text-center mb-1 pt-1">
      <button class="btn btn-success btn-lg go-btn"><span data-feather="check"></span>&nbsp;&nbsp;Check other time&nbsp;&nbsp;</button>
    </div>
  </div>
</div></div>
</div>
<div class="container" id="start" style="max-width:600px;min-height:80vh;padding-bottom:1rem">
  <div class="card card-outline-secondary" style="margin:-0.5rem;padding:0.5rem;background-color:#FAFAFA">
    <form id="chart-filter" autocomplete="off">
      @csrf
      <div class="form-group row">
        <label class="col-xs-12 col-form-label"><b>Canteens</b></label>
      </div>
      <div class="form-group row">
        <div class="col-xs-12 col-sm-12 col-md-10">
          <select class="form-control" name="canteen" id="canteen">
            <option>Default select</option>
            @foreach($rcs as $rc)
            <option>{{$rc}}</option>
            @endforeach
          </select>
          <span id="warning-account" class="form-control-feedback" style="display:none"></span>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <label class="col-xs-12 col-form-label"><b>Consumption Time</b></label>
      </div>
      <div class="form-group row">
        <label for="startDate"><h5>From</h5></label>
          <div class="col-xs-12 col-sm-12 col-md-10">
            <input type="date" class="form-control" name="startDate"  id="startDate" max="2018-10-20" min="2018-10-08">
        </div>
      </div>
      <div class="form-group row">
        <label for="startDate"><h5>To</h5></label>
          <div class="col-xs-12 col-sm-12 col-md-10">
            <input type="date" class="form-control" name="startDate"  id="startDate" max="2018-10-20" min="2018-10-08">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 text-xs-center">
      <button class="btn btn-primary" type="submit" id="submitBtn"><span data-feather="check"></span>&nbsp;&nbsp;Go&nbsp;&nbsp;</button>
      <button class="btn btn-danger" type="reset"><span data-feather="rotate-ccw"></span>&nbsp;Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script src="/js/chart.config.js"></script>
<script>
  $('#submitBtn').click(function(e){
    e.preventDefault();
  });
  $(function(){
    console.log($(window).height());
    if($(window).height()>=768){
      $('.occupy').height($(window).height()-$('nav').outerHeight());
      $(window).on('resize', function(){
        $('.occupy').height($(window).height()-$('nav').outerHeight());
      });
    }
    $('.occupy').fadeIn(1000);
    $('.go-btn').click(function(e){
      e.preventDefault();
      $('html,body').animate({scrollTop:$('#start').offset().top+$('nav').outerHeight()}, 600);
    });
  });
</script>
@endsection
