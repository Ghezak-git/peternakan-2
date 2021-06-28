<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrackTernak;
use App\Models\HistoryTrack;

class AdminController extends Controller
{
    public function user(){
        $user = User::with('biodata', 'statuskep', 'location')->where('is_admin', '!=' ,'ya')->get();
        if($user != null){
            return response()->json(['data' => $user], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function detailUser($id){
        $user = User::with('biodata','location')->where('id_user', '=' , $id)->first();
        if($user != null){
            return response()->json(['data' => $user], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function getTernak(Request $request){
        $getternak = TrackTernak::with('user','indikatorj')->where('id_user', '=', $request->input('id_user'))->where('indikator', '=', $request->input('indikator'))->first();
        if($getternak != null){
            return response()->json(['data' => $getternak], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function getHistory(Request $request){
        $getternak = HistoryTrack::with('indikatorj')->where('id_tp', '=', $request->input('id_tp'))->where('indikator', '=', $request->input('indikator'))->get();
        if($getternak != null){
            return response()->json(['data' => $getternak], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    
}
