<?php

namespace App\Http\Controllers;
use App\RC;
use App\Dummy;
use App\ApiConnector;
use Illuminate\Http\Request;

class MealInputController extends Controller
{
  private $mealApi='student/student_meal_consumption/v1.0.0/all?count';
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
    $apiConnector=new ApiConnector();
    foreach($rcs as $canteen){
      $ops='&consumption_location='.$canteen.'&consume_date_from='.urlencode($startDate).'&consume_date_to='.urlencode($endDate);
      $data=$apiConnector->fetchData($this->mealApi.$ops);
      // dd($data);
      $realTime[$canteen]=$data->_size;
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
    $apiConnector=new ApiConnector();
    if($request->canteen!=null){
      $ops='&consumption_location='.$request->canteen.'&consume_date_from='.urlencode($startDate).'&consume_date_to='.urlencode($endDate);
    }else{
      $ops='?consume_date_from='.urlencode($startDate).'&consume_date_to='.urlencode($endDate);
    }
    $data=$apiConnector->fetchData($this->mealApi.$ops);
    return response()->json(['count'=>$data->_size]);
  }
}
