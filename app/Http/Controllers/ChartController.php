<?php

namespace App\Http\Controllers;

use App\Dummy;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index()
    {
        return view('charts.all');
    }
    public function all(Request $request)
    {
        if ($request->isMethod('get')){
            $collections = Dummy::all('consumptionLocation','mealType','rcMember')->toArray();
            // return $collections;
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
            // return view('charts.master',compact(['pieData','locations','bubbleData','rcs']));
            return response()->json(['pieData'=>$pieData,'locations'=>$locations,'bubbleData'=>$bubbleData,'rcs'=>$rcs]);
        }
    }
}
