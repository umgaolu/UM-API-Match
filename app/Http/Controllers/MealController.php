<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiConnector;
use Carbon\CarbonPeriod;

class MealController extends Controller
{
  // private $rcList=['MLC','CKLC','CKYC','FPJC','MCMC','SPC','CYTC','SEAC','LCWC'];
  private $rcList=['MLC','CKLC','CKYC'];
  private $consumptionLocation=['MLC','CKLC','CKYC'];
  // private $consumptionLocation=['MLC','CKLC','CKYC','FPJC','MCMC','SPC','CYTC','SEAC','LCWC','HFPJC'];
  // private $rcList=['MLC'];
  private $mealType=["BREAKFAST","LUNCH","DINNER"];
  private $mealConsumption='student/student_meal_consumption/v1.0.0/all';
  private $connector;
  private $startTime='T00:00:00';
  private $endTime='T23:59:59';
  public function __construct(){
      $this->connector=new ApiConnector();
  }
  public function index()
  {
      return view('charts.meals');
  }
  private function connectApi($controls){
    $ops='?count';
    if(array_key_exists('consume_date_from',$controls)){
      $ops=$ops.'&consume_date_from='.$controls['consume_date_from'];
    }
    if(array_key_exists('consume_date_to',$controls)){
      $ops=$ops.'&consume_date_to='.$controls['consume_date_to'];
    }
    if(array_key_exists('consumption_location',$controls)){
      $ops=$ops.'&consumption_location='.$controls['consumption_location'];
    }
    if(array_key_exists('rcMember',$controls)){
      $ops=$ops.'&rcMember='.$controls['rcMember'];
    }
    if(array_key_exists('mealType',$controls)){
      $ops=$ops.'&mealType='.$controls['mealType'];
    }
    if(array_key_exists('page',$controls)){
      $ops=$ops.'&page='.$controls['page'];
    }
    if(array_key_exists('pagesize',$controls)){
      $ops=$ops.'&pagesize='.$controls['pagesize'];
    }
    $data=$this->connector->fetchData($this->mealConsumption.$ops);
    return $data;
  }
  public function collectData()
  {
    $startDate='2018-10-08';
    $endDate='2018-10-11';
    $period=new CarbonPeriod($startDate,$endDate);
    $days=[];
    foreach($period as $date){
      $days[]=$date->format('Y-m-d');
    }
    $lineData=[];
    $barData=[];
    $pieDataName=['name','value'];
    $pieData=[];
    $bubbleData=[];

    // line and pie
    $mealCounterPie=[];
    $locations=$this->consumptionLocation;
    sort($locations);
    foreach($locations as $locationKey=>$location){
      $mealCounterPie[$location]=0;
    }
    foreach($locations as $locationKey=>$location){
      $tempLine=[];
      foreach($period as $periodKey=>$date){
        $curDate=$date->toDateString();
        $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$this->startTime),'consume_date_to'=>urlencode($curDate.$this->endTime),'consumption_location'=>$location,'pagesize'=>1]);
        array_push($tempLine,$response->_size);
        $mealCounterPie[$location]=$mealCounterPie[$location]+$response->_size;
      }
      $lineData[$location]=$tempLine;
    }
    foreach($mealCounterPie as $key=>$value) {
      array_push($pieData,array_combine($pieDataName,array($key,$value)));
    }

    foreach($period as $periodKey=>$date){
      $curDate=$date->toDateString();
      $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$this->startTime),'consume_date_to'=>urlencode($curDate.$this->endTime),'pagesize'=>1]);
      $tempCollection=collect($response->_embedded);
      $tempCounter=[];
      foreach($this->mealType as $key=>$meal){
        $tempCounter[$meal]=0;
        $count=$tempCollection->where('mealType','=',$meal)->count();
        $tempCounter[$meal]=$tempCounter[$meal]+$count;
      }
      if($response->_total_pages>1){
        for($i=2;$i<=$response->_total_pages;$i++){
          $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$this->startTime),'consume_date_to'=>urlencode($curDate.$this->endTime),'page'=>$i,'pagesize'=>1]);
          $tempCollection=collect($response->_embedded);
          foreach ($this->mealType as $key=>$meal) {
            $count=$tempCollection->where('mealType','=',$meal)->count();
            $tempCounter[$meal]=$tempCounter[$meal]+$count;
          }
        }
      }
      $barData=array_merge_recursive($barData,$tempCounter);
    }

    $rcs=$this->rcList;
    sort($rcs);
    foreach($rcs as $rcKey=>$rc){
      foreach ($locations as $locationKey=>$location){
        $response=$this->connectApi(['consume_date_from'=>urlencode($startDate.$this->startTime),'consume_date_to'=>urlencode($endDate.$this->endTime),'rc_member'=>$rc,'consumption_location'=>$location,'pagesize'=>1]);
        if ($response->_size>0){
          // only numerial data can be used to draw scatter plot
          array_push($bubbleData,[$rcKey,$locationKey,$response->_size]);
        }
      }
    }
    return response()->json(['days'=>$days,'lineData'=>$lineData,'barData'=>$barData,'pieData'=>$pieData,'locations'=>$locations,'bubbleData'=>$bubbleData,'rcs'=>$rcs,'mealType'=>$this->mealType]);
  }
}
