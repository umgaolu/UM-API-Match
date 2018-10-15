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
        $collections = Dummy::all()->random(30);
        $fields = array_slice(array_keys((array)json_decode(json_encode($collections->first()))),1);
        // return json_encode($collections);
        // return view('dummies.index',compact(['collections','fields']));
        return view('inventories.index',compact(['collections','fields']));
    }
}
