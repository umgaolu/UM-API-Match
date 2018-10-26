<?php

namespace App\Http\Controllers;

use App\RC;
use Illuminate\Http\Request;

class FilterInputController extends Controller
{
  public function index()
  {
    $rcs=RC::all()->toArray();
    $rcs=array_column($rcs,'name');
    sort($rcs);
    return view('inputs.index',compact('rcs'));
  }
}
