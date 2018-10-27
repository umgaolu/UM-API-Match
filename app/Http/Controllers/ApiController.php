<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiConnector;

class ApiController extends Controller
{
    //
  private $rcList=['MLC','CKLC','CKYC','FPJC','MCMC','SPC','CYTC','SEAC','LCWC'];
  private $powerConsumption='facilities/power_consumption/v1.0.0/all';
  private $mealConsumption='student/student_meal_consumption/v1.0.0/all';
  private $events='media/events/v1.0.0/all';
  public function checkEvents(Request $request)
  {
    $apiConnector=new ApiConnector();
    $ops='?date_from='.$request->startDate.'&date_to='.$request->endDate.'&count';
    $data=$apiConnector->fetchData($this->events.$ops);
    if(!is_null($data)&&$data->_size>0){
      return response()->json(['status'=>'success']);
    }else{
      return response()->json(['status'=>'noData']);
    }
  }
  public function viewEvents(Request $request)
  {
    $apiConnector=new ApiConnector();
    $temp=[];
    $ops='?date_from='.$request->startDate.'&date_to='.$request->endDate.'&count';
    $data=$apiConnector->fetchData($this->events.$ops);
    if(!is_null($data)&&$data->_size>0){
      foreach($data->_embedded as $value){
        array_push($temp,['dateFrom'=>$value->common->dateFrom,'dateTo'=>$value->common->dateTo,'title'=>$value->details[0]->title]);
      }
      $pages=$data->_total_pages;
      if($pages>1){
        for($i=2;$i<$pages+1;$i++){
          $ops='?date_from='.$request->startDate.'&date_to='.$request->endDate.'&count'.'&page='.$i;
          $data=$apiConnector->fetchData($this->events.$ops);
          if(!is_null($data)&&$data->_size>0){
            foreach($data->_embedded as $value){
              array_push($temp,['dateFrom'=>$value->common->dateFrom,'dateTo'=>$value->common->dateTo,'title'=>$value->details[0]->title]);
            }
          }
        }
      }
      return view('events.show')->with(['data'=>$temp]);
    }
  }
}
