@extends('layouts.master')

@section('content')
<div class="row occupy lign-items-center justify-content-center">
  <div class="col-12 align-self-center">
    <form id="chart-filter" method="POST" action="/charts" novalidate autocomplete="off">
      @csrf
      <div class="row align-items-center justify-content-center">
        <div class="col-8 col-md-6 align-self-center">
          <div class="py-1 text-justify"><!--
            <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="72"> -->
            <h2>Some text</h2>
            <p class="lead">Short message</p>
          </div>
        </div>
      </div>
      <div class="row align-items-start justify-content-center">
        <div class="form-group col-8 col-md-2 mb-1 rc-check">
          <h5>RC Member</h5>
          @foreach($rcs as $rc)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$rc}}" id="rc-{{$rc}}" name="rc[]"><label class="form-check-label" for="rc-{{$rc}}">{{$rc}}</label>
          </div>
          @endforeach
          <div class="invalid-feedback">
          </div>
        </div>
        <div class="form-group col-8 col-md-2 mb-1 canteen-check">
          <h5>RC Canteen</h5>
          @foreach($rcs as $rc)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$rc}}" id="canteen-{{$rc}}" name="canteen[]"><label class="form-check-label" for="canteen-{{$rc}}">{{$rc}}</label>
          </div>
          @endforeach
          <div class="invalid-feedback">
          </div>
        </div>
        <div class="form-group col-8 col-md-2 mb-1 meal-check">
          <h5>Meal</h5>
          @foreach(['BREAKFAST','LUNCH','DINNER'] as $meal)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$meal}}" id="{{$meal}}" name="meal[]"><label class="form-check-label" for="{{$meal}}">{{ucwords(strtolower($meal))}}</label>
          </div>
          @endforeach
          <div class="invalid-feedback">
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="form-group col-8 col-md-2 mb-1">
          <label for="startDate"><h5>Date from</h5></label>
          <div class="input-group date" id="startDate">
            <input type="date" class="form-control" name="startDate" max="2018-10-20" min="2018-10-08">
          </div>
        </div>
        <div class="form-group col-8 col-md-2 mb-1">
          <label for="endDate"><h5>Date to</h5></label>
          <div class="input-group date" id="endDate">
            <input type="date" class="form-control" name="endDate" max="2018-10-20" min="2018-10-08">
          </div>
        </div>
      </div>
      <div class="row justify-content-center"><div class="form-group col-8 col-md-6 mb-1"><hr></div></div>
      <div class="row justify-content-center">
        <div class="form-group col-sm-8 align-self-center text-center mb-1 pt-1">
          <button class="btn btn-primary" type="submit" id="submitBtn"><span data-feather="check"></span>&nbsp;&nbsp;Go&nbsp;&nbsp;</button>
          <button class="btn btn-danger" type="reset"><span data-feather="rotate-ccw"></span>&nbsp;Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $('#submitBtn').click(function(e){
    // e.preventDefault();
    var rcs=[];
    var canteens=[];
    var meals=[];
    $.each($("input[name='rc[]']:checked"), function(){
      rcs.push($(this).val());
    });
    $.each($("input[name='canteen[]']:checked"), function(){
      canteens.push($(this).val());
    });
    $.each($("input[name='meal[]']:checked"), function(){
      meals.push($(this).val());
    });
    console.table({'rc':rcs,'canteen':canteens,'meal':meals})
    $('.chart-filter').submit();
  });
  $(function(){
    console.log($(window).height());
    if($(window).height()>=768){
      $('.occupy').height($(window).height()-$('nav').outerHeight()*2);
      $(window).on('resize', function(){
        $('.occupy').height($(window).height()-$('nav').outerHeight()*2);
      });
    }
  });
  (function(){
    'use strict';
    window.addEventListener('load',function(){
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms=document.getElementsByClassName('chart-filter');
    // Loop over them and prevent submission
    var validation=Array.prototype.filter.call(forms,function(form){
      form.addEventListener('submit',function(event){
        if(form.checkValidity()===false){
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      },false);
    });
  },false);
  })();
</script>
@endsection
