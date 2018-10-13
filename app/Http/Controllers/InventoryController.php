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

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Inventory  $inventory
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Inventory $inventory)
    // {
    //     //
    // }

    // *
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Inventory  $inventory
    //  * @return \Illuminate\Http\Response

    // public function edit(Inventory $inventory)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Inventory  $inventory
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Inventory $inventory)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Inventory  $inventory
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Inventory $inventory)
    // {
    //     //
    // }
}
