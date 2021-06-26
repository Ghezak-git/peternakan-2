<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackTernak;
use App\Models\HistoryTrack;
use App\Models\User;

class TrackTernakController extends Controller
{
    public function index(Request $request)
    {
        $trackternak = TrackTernak::with('indikatorj','user')->where('id_user', '=', $request->input('id_user'))->where('indikator','=',$request->input('indikator'))->first();
        if($trackternak != null){
            return response()->json(['data' => $trackternak], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function history(Request $request)
    {
        $hisotrytrack = HistoryTrack::with('indikatorj')->where('id_tp', '=', $request->input('id_tp'))->where('indikator','=',$request->input('indikator'))->get();
        if($hisotrytrack != null){
            return response()->json(['data' => $hisotrytrack], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function store(Request $request)
    {
        $cekexist = TrackTernak::where('id_user', '=', $request->input('id_user'))->where('indikator', '=', $request->input('indikator'))->first();
        if($cekexist == null){
            if($request->has('id_user') && $request->has('indikator')  && $request->has('jumlah_jantan') 
            && $request->has('jumlah_betina')  && $request->has('date')) {
                $trackternak = new TrackTernak(); 
                $trackternak->id_user = $request->input('id_user');
                $trackternak->indikator = $request->input('indikator');
                $trackternak->jumlah_jantan = $request->input('jumlah_jantan');
                $trackternak->jumlah_betina = $request->input('jumlah_betina');
                $trackternak->date = $request->input('date');
                $trackternak->createdAt = NOW();
                $trackternak->save();
                return response()->json(['data' => $trackternak, 'message' => 'Berhasil Disimpan'], 201);
            }else{
                return response()->json(['message' => 'Periksa Input anda'], 501);
            }
        }else{
            if($request->has('jumlah_jantan') && $request->has('jumlah_betina') && $request->has('date')) {
                
                /* ------ Save History ------ */
                $hisotrytrack = new HistoryTrack(); 
                $hisotrytrack->id_tp = $cekexist->id_tp;
                $hisotrytrack->indikator = $cekexist->indikator;
                $hisotrytrack->jumlah_jantan = $cekexist->jumlah_jantan;
                $hisotrytrack->jumlah_betina = $cekexist->jumlah_betina;
                $hisotrytrack->date = $cekexist->date;
                $hisotrytrack->createdAt = NOW();
                $hisotrytrack->save();
                
                /* ------ Update Ternak ------ */
                $trackternak = TrackTernak::findOrFail($cekexist->id_tp);
                $trackternak->jumlah_jantan = $request->input('jumlah_jantan');
                $trackternak->jumlah_betina = $request->input('jumlah_betina');
                $trackternak->date = $request->input('date');
                $trackternak->updatedAt = NOW();
                $trackternak->save();

                return response()->json(['data' => $hisotrytrack, 'message' => 'Berhasil Di Update'], 201);
            }else{
                return response()->json(['message' => 'Periksa Input anda'], 501);
            }
        }
    }

    
}
