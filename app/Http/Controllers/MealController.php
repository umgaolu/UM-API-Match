<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiConnector;
use Carbon\CarbonPeriod;

class MealController extends Controller
{
  // private $rcList=['MLC','CKLC','CKYC','FPJC','MCMC','SPC','CYTC','SEAC','LCWC'];
  private $rcList=['MLC','CKLC','CKYC'];
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
    $endDate='2018-10-10';
    // record counter can be returned by the API

    // // count by total amount and consumption location (line chart)
    // sort($this->rcList);
    // $seriesLocationDate=[];
    // foreach($this->rcList as $rcKey=>$rc){
    //   $tempSeries=[];
    //   foreach($period as $periodKey=>$date){
    //     $curDate=$date->toDateString();
    //     $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$startTime),'consume_date_to'=>urlencode($curDate.$endTime),'consumption_location'=>$rc,'pagesize'=>1]);
    //     array_push($tempSeries,$response->_size);
    //   }
    //   $seriesLocationDate[$rc]=$tempSeries;
    // }

    // // count by location (pie chart)
    // $seriesLocation=[];
    // $seriesLocationKeys=['name','value'];
    // foreach($this->rcList as $rcKey=>$rc){
    //   $response=$this->connectApi(['consume_date_from'=>urlencode($startDate.$startTime),'consume_date_to'=>urlencode($endDate.$endTime),'consumption_location'=>$rc,'pagesize'=>1]);
    //   array_push($seriesLocation,array_combine($seriesLocationKeys,[$rc,$response->_size]));
    // }
    // get all data from API
    $data=array();
    $dataIndex=0;
    foreach ($this->rcList as $location) {
      $response=$this->connectApi(['consume_date_from'=>urlencode($startDate.$this->startTime),'consume_date_to'=>urlencode($endDate.$this->endTime),'consumption_location'=>$location]);
      foreach($response->_embedded as $key=>$value){
        $data=array_merge($data,[$dataIndex=>json_decode(json_encode($value,True))]);
        $dataIndex++;
      }
      if($response->_total_pages>1){
        for ($i=2;$i<=$response->_total_pages;$i++) {
          $response=$this->connectApi(['consume_date_from'=>urlencode($startDate.$this->startTime),'consume_date_to'=>urlencode($endDate.$this->endTime),'consumption_location'=>$location,'page'=>$i]);
          foreach($response->_embedded as $key=>$value){
            $data=array_merge($data,[$dataIndex=>$value]);
            $dataIndex++;
          }
        }
      }
    }
    if(!is_null($data)){
      return $this->convertData($data,$startDate,$endDate);
      // var_dump($data);
      // return $data;
    }
  }
  public function convertData($data,$startDate,$endDate)
  {
    $period=new CarbonPeriod($startDate,$endDate);
    $days=[];
    foreach($period as $date){
      $days[]=$date->format('Y-m-d');
    }
    $collections=collect($data);
    // dd($data);
    $consumptionLocation=array_column($data, 'consumptionLocation');
    $locationCount=array_count_values($consumptionLocation);
    $locations=array_keys($locationCount);
    sort($locations);

    $lineData=[];
    // foreach($locations as $locationKey=>$location){
    //   $tempSeries=[];
    //   foreach($period as $periodKey=>$date){
    //     $curDate=$date->toDateString();
    //     $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$this->startTime),'consume_date_to'=>urlencode($curDate.$this->endTime),'consumption_location'=>$location,'pagesize'=>1]);
    //     array_push($tempSeries,$response->_size);
    //     // // collections cannot use where to check date
    //     // $count=$collections->where('consumeTime','like',$curDate.'%')->where('consumptionLocation','=',$location)->count();
    //     // array_push($tempSeries,$count);
    //   }
    //   $lineData[$location]=$tempSeries;
    // }

    $barData=[];
    // foreach($this->mealType as $mealKey=>$meal){
    //   $tempSeries=[];
    //   foreach($period as $periodKey=>$date){
    //     $curDate=$date->toDateString();
    //     $response=$this->connectApi(['consume_date_from'=>urlencode($curDate.$this->startTime),'consume_date_to'=>urlencode($curDate.$this->endTime),'mealType'=>$meal,'pagesize'=>1]);
    //     array_push($tempSeries,$response->_size);
    //     // $count=$collections->where('consumeTime','like',$curDate.'%')->where('mealType','=',$meal)->count();
    //     // array_push($tempSeries,$count);
    //   }
    //   $barData[$meal]=$tempSeries;
    // }

    $pieDataName=['name','value'];
    $pieData=[];
    foreach($locationCount as $key=>$value) {
      array_push($pieData,array_combine($pieDataName,array($key,$value)));
    }

    // use array_values to ensure the index is in order
    // the three lines below can be commented out if $rcs is passed from input
    $rcMember=array_column($data, 'rcMember');
    $rcs=array_values(array_unique($rcMember));
    sort($rcs);
    $bubbleData=[];
    foreach($rcs as $rcKey=>$rc){
      foreach ($locations as $locationKey=>$location){
        $count=$collections->where('rcMember',$rc)->where('consumptionLocation',$location)->count();
        if ($count>0){
          // only numerial data can be used to draw scatter plot
          array_push($bubbleData,[$rcKey,$locationKey,$count]);
        }
      }
    }
    // // below is used to print multiple category of bubble chart
    // foreach($this->mealType as $mealkey=>$meal){
    //   $tempData=[];
    //   foreach($rcs as $rcKey=>$rc){
    //     foreach ($locations as $locationKey=>$location){
    //       $count=$collections->where('mealType','=',$meal)->where('rcMember','=',$rc)->where('consumptionLocation','=',$location)->count();
    //       if ($count>0) {
    //         // only numerial data can be used to draw scatter plot
    //         array_push($tempData,[$rcKey,$locationKey,$count]);
    //       }
    //     }
    //   }
    //   $bubbleData[$meal]=$tempData;
    // }
    return response()->json(['days'=>$days,'lineData'=>$lineData,'barData'=>$barData,'pieData'=>$pieData,'locations'=>$locations,'bubbleData'=>$bubbleData,'rcs'=>$rcs,'mealType'=>$this->mealType]);
  }
}
