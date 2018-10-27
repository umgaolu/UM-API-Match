@extends('layouts.master')
@section('content')
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="loadingTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body mx-auto">
        <img src="/loading.gif" id="status-img" alt="">
        <h4 class="text-info text-center" id="status-text" style="padding-top:1rem;padding-bottom:1rem">Loading...</h4>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" role="main" style="font-size: 16px;">
<div class="row occupy align-items-center justify-content-center" style="display: none;">
<div class="col-md-5 col-xs-10 align-self-center">
  <div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h4 class="text-info text-xs-center" style="padding-top:1rem;padding-bottom:1rem">What would you like to know?</h4></div>
  <div class="card-body text-dark">
<form class="form-event" autocomplete="off" method="POST" action="/viewEvents">
  @csrf

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Languages</label>
    <div class="col-sm-9">
      <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="Cantonese" name="languages[]" value="Cantonese">
      <label class="form-check-label" for="Cantonese">Cantonese</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="Mandarin" name="languages[]" value="Mandarin">
        <label class="form-check-label" for="Mandarin">Mandarin</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="English" name="languages[]" value="English">
        <label class="form-check-label" for="English">English</label>
      </div>
      </div>
  </div>
  <div class="form-group row">
    <label for="startDate" class="col-sm-3 col-form-label">Date From</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="startDate" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="startDate" value="{{date('Y-m-d')}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="endDate" class="col-sm-3 col-form-label">Date To</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="endDate" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="endDate" value="{{date('Y-m-d',time()+86400*7)}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Smart Points</label>
    <div class="col-sm-9">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="sp[]" id="hasSp" value="true">
        <label class="form-check-label" for="hasSp">Yes</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="sp[]" id="noSp" value="false">
        <label class="form-check-label" for="noSp">No</label>
      </div>
    </div>
  </div>
  <div class="form-group row align-items-center justify-content-center">
    <div class="col-8 align-self-center">
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
    $.ajaxSetup({
      headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    console.table({'startDate':$('#startDate').val(),'endDate':$('#endDate').val(),'sp':$("input[name='sp[]']:checked").val()});
    $('#loading').modal('show');
    e.preventDefault();
    var languages=[];
    $.each($("input[name='languages[]']:checked"), function(){
      languages.push($(this).val());
    });
    $.ajax({
      url:'/checkEvents',
      dataType:'json',
      type:'post',
      data:{'startDate':$('#startDate').val(),'endDate':$('#endDate').val(),'sp':$("input[name='sp[]']:checked").val()},
      success:function(data){
        if(data.status=='success'){
          $("#status-img").attr("src","");
          $('#status-text').text("Success!!!").fadeOut("slow",function(){
            $('.form-event').submit();
            $('#loading').modal('hide');
          });
          console.log(data);
        }
      },
      error:function(data){console.log('Error from line:',data);}
    });
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
