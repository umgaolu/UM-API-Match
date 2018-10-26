<?php

namespace App\Http\Controllers;

use App\Dummy;
use Illuminate\Http\Request;

class DummyController extends Controller
{
    //
    public function index()
    {
        //@todo use AJAX to split request for different charts in different method
        $collections = Dummy::all('consumptionLocation','mealType','rcMember')->toArray();
        // $temp = (array)json_decode(json_encode($collections));
        $consumptionLocation=array_column($collections, 'consumptionLocation');
        // $mealType=array_column($collections, 'mealType');
        $rcMember=array_column($collections, 'rcMember');
        $locationCount=array_count_values($consumptionLocation);
        $locations=array_keys($locationCount);
        $pieDataName=array('name','value');
        $pieData=[];
        foreach ($locationCount as $key => $value) {
          array_push($pieData,array_combine($pieDataName,array($key,$value)));
        }
        // use array_values to ensure the index is in order
        $rcs=array_values(array_unique($rcMember));
        $bubbleData=[];
        foreach ($rcs as $rcKey=>$rc) {
          foreach ($locations as $locationKey=>$location) {
            $count=Dummy::where('rcMember', '=', $rc)->where('consumptionLocation', '=', $location)->count();
            if ($count>0) {
              // only numerial data can be used to draw scatter plot
              array_push($bubbleData, array($rcKey,$locationKey,$count));
            }
          }
        }
        // $name = [
        //     '' =>
        // ];
        // dd($bubbleData);
        // $fields = array_slice(array_keys((array)json_decode(json_encode($collections->first()))),1);
        // return json_encode($collections);
        // return view('dummies.index',compact(['collections','fields']));
        return view('inventories.index',compact(['pieData','locations','bubbleData','rcs']));
    }
}
