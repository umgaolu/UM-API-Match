<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventories = Inventory::all();
        $fields = array_slice(array_keys((array)json_decode(json_encode($inventories->first()))),1);
        return view('inventories.index',compact(['inventories','fields']));
    }

}
