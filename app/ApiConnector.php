<?php

namespace App;

// use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiConnector
{
  private $client;
  private $headers;
  public function __construct(){
      $this->client=new Client(['base_uri'=>'https://api.data.umac.mo/service/']);
      $this->headers=['Authorization'=>'Bearer 0e1156d0-1c16-3fad-b171-1066f6782666','Accept'=>'application/json'];
  }
  public function fetchData($uri='')
  {
    if($uri!=''){
      $res=$this->client->request('GET',$uri,['headers'=>$this->headers]);
      if ($res->getStatusCode()!=200){
        return NULL;
      }
      return json_decode($res->getBody());
    }else{
      return NULL;
    }
  }
}
