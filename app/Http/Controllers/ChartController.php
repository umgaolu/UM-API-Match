<?php

namespace App\Http\Controllers;

use App\Dummy;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
class ChartController extends Controller
{
    //
  public function index()
  {
    return view('charts.all');
  }
  public function all(Request $request)
  {
    $startDate='2018-10-08';
    $endDate='2018-10-20';
    $startTime='T00:00:00';
    $endTime='T23:59:59';
    $period=new CarbonPeriod($startDate,$endDate);
    foreach($period as $date){
      $days[]=$date->format('Y-m-d');
    }
    $period=new CarbonPeriod($startDate,$endDate);
    if ($request->isMethod('get')){
      $collections=Dummy::all('consumptionLocation','mealType','rcMember')->toArray();
            // return $collections;
            // $temp = (array)json_decode(json_encode($collections));
      $consumptionLocation=array_column($collections, 'consumptionLocation');
      $mealType=["BREAKFAST","LUNCH","DINNER"];
      $rcMember=array_column($collections, 'rcMember');
      $locationCount=array_count_values($consumptionLocation);
      $locations=array_keys($locationCount);
      $lineData=[];
      foreach($locations as $locationKey=>$location){
        $tempSeries=[];
        foreach($period as $periodKey=>$date){
          $curDate=$date->toDateString();
          // collections cannot use where to check date
          $count=Dummy::where('consumeTime','like',$curDate.'%')->where('consumptionLocation','=',$location)->count();
          array_push($tempSeries,$count);
        }
        $lineData[$location]=$tempSeries;
      }
      $barData=[];
      foreach($mealType as $mealKey=>$meal){
        $tempSeries=[];
        foreach($period as $periodKey=>$date){
          $curDate=$date->toDateString();
          $count=Dummy::where('consumeTime','like',$curDate.'%')->where('mealType','=',$meal)->count();
          array_push($tempSeries,$count);
        }
        $barData[$meal]=$tempSeries;
      }
      $pieDataName=array('name','value');
      $pieData=[];
      foreach ($locationCount as $key=>$value) {
        array_push($pieData,array_combine($pieDataName,array($key,$value)));
      }
      // use array_values to ensure the index is in order
      $rcs=array_values(array_unique($rcMember));
      $bubbleData=[];
      foreach ($rcs as $rcKey=>$rc) {
        foreach ($locations as $locationKey=>$location) {
          $count=Dummy::where('rcMember','=',$rc)->where('consumptionLocation','=',$location)->count();
          if ($count>0) {
                      // only numerial data can be used to draw scatter plot
            array_push($bubbleData, array($rcKey,$locationKey,$count));
          }
        }
      }
      // return view('charts.master',compact(['pieData','locations','bubbleData','rcs']));
      return response()->json(['days'=>$days,'lineData'=>$lineData,'barData'=>$barData,'pieData'=>$pieData,'locations'=>$locations,'bubbleData'=>$bubbleData,'rcs'=>$rcs,'mealType'=>$mealType]);
    }
  }
}
