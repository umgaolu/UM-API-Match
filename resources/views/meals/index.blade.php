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
              <p id="{{$rc}}-counting" class="text-alert">50</p id="{{$rc}}-counting">
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
              <p id="{{$rc}}-counting" class="text-success">10</p id="{{$rc}}-counting">
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
              <p id="{{$rc}}-counting" class="text-success">10</p id="{{$rc}}-counting">
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="row align-items-center justify-content-center"><div class="col-10 col-md-6 mb-1"><hr></div></div>
  <div class="row align-items-center justify-content-center">
    <div class="col-sm-8 align-self-center text-center mb-3 py-1">
      <button class="btn btn-success btn-lg go-btn"><span data-feather="check"></span>&nbsp;&nbsp;Check other time&nbsp;&nbsp;</button>&nbsp;&nbsp;
      <a href="/showCharts" class="btn btn-outline-info btn-lg" role="button"><span data-feather="thumbs-up"></span>&nbsp;&nbsp;Spoiler&nbsp;&nbsp;</a>
    </div>
  </div>
</div></div>
</div>
<div class="container py-3" id="filter" style="max-width:750px;min-height:90vh;display:none">
  <div class="card border-dark">
    <div class="card-header"><h4 class="text-info text-xs-center" style="padding-top:1rem;padding-bottom:1rem">When and where do you want to check?</h4></div>
    <div class="card-body">
    <form id="chart-filter" autocomplete="off">
      @csrf
      <div class="form-group row">
        <label class="col-md-2  col-form-label d-sm-none d-md-block" for="canteen"><h5>Canteens</h5></label>
        <div class="col-12 col-md-10">
          <select class="form-control" name="canteen" id="canteen">
            <option value="">--Canteen--</option>
            @foreach($rcs as $rc)
            <option value="{{$rc}}">{{$rc}}</option>
            @endforeach
          </select>
          <span id="warning-account" class="form-control-feedback" style="display:none"></span>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <label class="col-12 col-form-label"><h5>Consumption Time</h5></label>
      </div>
      <div class="form-group row">
        <label for="startDate" class="col-2  col-form-label"><h5>From</h5></label>
          <div class="col-10">
            <input class="form-control" type="text" id="startDate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD  HH : mm" name="startDate" value="{{date('Y-m-d H:i',round((time()-1200)/1200)*1200)}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="endDate" class="col-2  col-form-label"><h5>To</h5></label>
          <div class="col-10">
            <input class="form-control" type="text" id="endDate" data-format="YYYY-MM-DD HH:mm" data-template="YYYY / MM / DD  HH : mm" name="endDate" value="{{date('Y-m-d H:i',round(time()/1200)*1200)}}">
        </div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col-xs-12 text-xs-center">
          <button class="btn btn-primary" type="submit" id="submitBtn"><span data-feather="check"></span>&nbsp;&nbsp;Go&nbsp;&nbsp;</button>
          <button class="btn btn-danger" type="reset"><span data-feather="rotate-ccw"></span>&nbsp;Reset</button>
        </div>
      </div>
    </form>
  </div>
  </div>
</div>
<div class="modal fade" id="showMeals" tabindex="-1" role="dialog" aria-labelledby="loadingTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Realtime Meal Consumption</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
        <h4 class="text-info text-center" id="status-text"></h4>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $.ajaxSetup({
      headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      url:'/checkMeals',
      dataType:'json',
      type:'post',
      data:{'startDate':$('#startDate').val(),'endDate':$('#endDate').val(),'canteen':$('#canteen').val()},
      success:function(data){
          $("#status-img").attr("src","");
          if($('#canteen').val()){
            $('#status-text').text("There are currently "+data.count+" students enjoying meal at "+$('#canteen').val()+" canteen.");
          }else{
            $('#status-text').text("There are currently "+data.count+" students enjoying meal at all RC");
          }
          $('#showMeals').modal('show');
    }
  });
  });
  $(function(){
    $('#startDate').combodate();
    $('#endDate').combodate();
    $('.nav-item').removeClass('active');
    $('.nav-meal').addClass('active');
    if($(window).height()>=768){
      $('.occupy').height($(window).height()-$('nav').outerHeight());
      $(window).on('resize', function(){
        $('.occupy').height($(window).height()-$('nav').outerHeight());
      });
    }
    $('.occupy').fadeIn(1000);
    $('.go-btn').click(function(e){
      e.preventDefault();
      // $(this).hide();
      $('html,body').animate({scrollTop:$('.container-fluid').height()+$('nav').outerHeight()}, 600);
      $('#filter').fadeIn(1000);
    });
  });
</script>
@endsection
