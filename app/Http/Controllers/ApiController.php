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
  public function index()
  {
    $apiConnector=new ApiConnector();
    // $ops='?meter_code=6A05_7&recordDatetime=2018-10-0[1-7]{1}T[0][8]:[0]{2}:[0]{2}+\d{2}:[0]{2}&count';
    $ops='?consumption_location=CKLC&consume_date_from=2018-10-08&consume_date_to=2018-10-14&count';
    $data=$apiConnector->fetchData($this->mealConsumption.$ops);
    if(!is_null($data)){
      dd($data);
    }
    // $dateTimePattern='\d{4}-\d{2}-\d{2}T02:00:00+08:00';
    // '?consumption_location=CKLC&consume_date_from=2018-10-08&consume_date_to=2018-10-14'
  }
}
