<?php

namespace App\Http\Controllers;

use App\Dummy;
use Illuminate\Http\Request;

class DummyController extends Controller
{
    //
    public function index()
    {
        //
        $collections = Dummy::all();
        $fields = array_slice(array_keys((array)json_decode(json_encode($collections->first()))),1);
        return $collections.toArray();
        // return view('dummies.index',compact(['collections','fields']));
    }
}
