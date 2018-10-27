<?php

namespace App\Http\Controllers;
use App\RC;
use App\Dummy;
use Illuminate\Http\Request;

class MealInputController extends Controller
{
  public function index()
  {
    $rcs=RC::all()->toArray();
    $rcs=array_column($rcs,'name');
    sort($rcs);
    $startDate=date('Y-m-d H:i',round((time()-2400)/2400)*2400);
    $startDate=preg_replace('/\s+/','T',$startDate);
    $startDate=$startDate.':00+08:00';
    $endDate=date('Y-m-d H:i',round((time()-1200)/1200)*1200);
    $endDate=preg_replace('/\s+/','T',$endDate);
    $endDate=$endDate.':00+08:00';
    $realTime=[];
    foreach($rcs as $canteen){
      $count=Dummy::where('consumptionLocation',$canteen)->whereBetween('consumeTime',[$startDate,$endDate])->count();
      $realTime[$canteen]=$count;
    }
    return view('meals.index')->with(['rcs'=>$rcs,'realTime'=>$realTime]);
  }
  public function checkMeals(Request $request)
  {
    $startDate=$request->startDate;
    $endDate=$request->endDate;
    $startDate=preg_replace('/\s+/','T',$startDate);
    $startDate=$startDate.':00+08:00';
    $endDate=preg_replace('/\s+/','T',$endDate);
    $endDate=$endDate.':00+08:00';
    if($request->canteen!=null){
      $count=Dummy::where('consumptionLocation',$request->canteen)->whereBetween('consumeTime',[$startDate,$endDate])->count();
    }else{
      $count=Dummy::whereBetween('consumeTime',[$startDate,$endDate])->count();
    }
    return response()->json(['count'=>$count]);
  }
}
