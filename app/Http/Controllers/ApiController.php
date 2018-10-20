<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiController extends Controller
{
    //
  public function index()
  {
    $client = new Client([
      'base_uri'=>'https://api.data.umac.mo/service/',
    ]);
    $token='0e1156d0-1c16-3fad-b171-1066f6782666';
    $headers=['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'];
    $res=$client->request('GET','facilities/power_consumption/v1.0.0/all',['headers'=>$headers]);
    if ($res->getStatusCode()!=200){
      // Handle error
    }
    $data=json_decode($res->getBody());
    dd($data);
  }
}
