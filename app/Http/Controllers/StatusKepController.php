<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusKep;
use App\Models\User;

class StatusKepController extends Controller
{
    public function index($id)
    {
        $statuskep = StatusKep::where('id_user', '=', $id)->first();
        if($statuskep != null){
            return response()->json(['data' => $statuskep], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function store(Request $request)
    {
        $cekuser = User::where('id_user', '=', $request->input('id_user'))->first();
        $ceksk = StatusKep::where('id_user', '=', $request->input('id_user'))->first();
        if($cekuser == null){
            return response()->json(['message' => 'ID anda tidak terdaftar'], 404);
        }elseif($ceksk != null){
            return response()->json(['message' => 'Status Kepemilikan telah dibuat'], 404);
        }
        if($request->has('id_user') && $request->has('jenis_ternak')  && $request->has('jumlah') 
        && $request->has('kpmlkn_lahan')  && $request->has('kandang') && $request->has('pakan')
        && $request->has('peralatan') && $request->has('tujuan') && $request->has('bentuk_produksi')) {
            $statuskep = new StatusKep(); 
            $statuskep->id_user = $request->input('id_user');
            $statuskep->jenis_ternak = $request->input('jenis_ternak');
            $statuskep->jumlah = $request->input('jumlah');
            $statuskep->kpmlkn_lahan = $request->input('kpmlkn_lahan');
            $statuskep->kandang = $request->input('kandang');
            $statuskep->pakan = $request->input('pakan');
            $statuskep->peralatan = $request->input('peralatan');
            $statuskep->tujuan = $request->input('tujuan');
            $statuskep->bentuK_produksi = $request->input('bentuk_produksi');
            $statuskep->createdAt = NOW();
            $statuskep->save();
            return response()->json(['data' => $statuskep, 'message' => 'Berhasil dibuat'], 201);
        }else{
            return response()->json(['message' => 'Periksa Kembali Input anda'], 501);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id_sp') && $request->has('jenis_ternak')  && $request->has('jumlah') 
        && $request->has('kpmlkn_lahan')  && $request->has('kandang') && $request->has('pakan')
        && $request->has('pakan') && $request->has('peralatan') && $request->has('tujuan') 
        && $request->has('bentuk_produksi')) {
            $statuskep = StatusKep::findOrFail($request->input('id_sp'));
            // $statuskep->id_user = $request->input('id_user');
            $statuskep->jenis_ternak = $request->input('jenis_ternak');
            $statuskep->jumlah = $request->input('jumlah');
            $statuskep->kpmlkn_lahan = $request->input('kpmlkn_lahan');
            $statuskep->kandang = $request->input('kandang');
            $statuskep->pakan = $request->input('pakan');
            $statuskep->pakan = $request->input('pakan');
            $statuskep->peralatan = $request->input('peralatan');
            $statuskep->tujuan = $request->input('tujuan');
            $statuskep->bentuK_produksi = $request->input('bentuk_produksi');
            $statuskep->updatedAt = NOW();
            $statuskep->save();
            return response()->json(['data' => $statuskep, 'message' => 'Berhasil di ubah'], 201);
        }else{
            return response()->json(['message' => 'Periksa Kembali input anda'], 501);
        }
    }
}
