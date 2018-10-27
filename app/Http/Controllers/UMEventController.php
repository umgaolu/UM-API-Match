<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UMEvent;


class UMEventController extends Controller
{
  public function index(Request $request)
  {
    if($request->isMethod('get')){
      return view('events.index');
    }

  }
  public function checkEvents(Request $request)
  {
    $q=UMEvent::whereBetween('common->dateFrom',[$request->startDate,$request->endDate]);
    // if(count($request->languages)>0){
    //   foreach($request->languages as $key=>$value){
    //      $q=$q->where('languages','all',[$key=>$value]);
    //   }
    // }
    dd($request->sp);
    if($request->sp!=null){
      $q=$q->where('smartPoint',$request->sp);
    }
    if($q->count()>0){
      return response()->json(['status'=>'success']);
    }else{
      return response()->json(['status'=>'noData']);
    }

  }
}
