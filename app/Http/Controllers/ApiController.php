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
  public function index(Request $request)
  {
    $apiConnector=new ApiConnector();
    $ops='?date_from='.$request->startDate.'&date_to='.$request->endDate.'&count';
    $data=$apiConnector->fetchData($this->events.$ops);
    if(!is_null($data)){
      dd($data);
    }
  }
}
