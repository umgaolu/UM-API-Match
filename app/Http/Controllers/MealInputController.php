<?php

namespace App\Http\Controllers;
use App\RC;
use Illuminate\Http\Request;

class MealInputController extends Controller
{
  public function index()
  {
    $rcs=RC::all()->toArray();
    $rcs=array_column($rcs,'name');
    sort($rcs);
    return view('meals.index',compact('rcs'));
  }
}
