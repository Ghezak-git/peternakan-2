<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\User;

class BiodataController extends Controller
{
    
    public function index($id)
    {
        $biodata = Biodata::where('id_user', '=', $id)->first();
        if($biodata != null){
            return response()->json(['data' => $biodata], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function store(Request $request)
    {
        $cekuser = User::where('id_user', '=', $request->input('id_user'))->first();
        $cekbio = Biodata::where('id_user', '=', $request->input('id_user'))->first();
        if($cekuser == null){
            return response()->json(['message' => 'ID ini tidak terdaftar'], 404);
        }elseif($cekbio != null){
            return response()->json(['message' => 'Biodata sudah dibuat'], 404);
        }
        if($request->has('id_user') && $request->has('alamat')  && $request->has('jk') 
        && $request->has('pendidikan')  && $request->has('usia') && $request->has('anggota_keluarga')
        && $request->has('status_pekerjaan') && $request->has('lama_beternak')) {
            $biodata = new Biodata(); 
            $biodata->id_user = $request->input('id_user');
            $biodata->alamat = $request->input('alamat');
            $biodata->jk = $request->input('jk');
            $biodata->pendidikan = $request->input('pendidikan');
            $biodata->usia = $request->input('usia');
            $biodata->anggota_keluarga = $request->input('anggota_keluarga');
            $biodata->status_pekerjaan = $request->input('status_pekerjaan');
            $biodata->lama_beternak = $request->input('lama_beternak');
            $biodata->createdAt = NOW();
            $biodata->save();
            return response()->json(['data' => $biodata, 'message' => 'Berhasil Disimpan'], 201);
        }else{
            return response()->json(['message' => 'Periksa Input anda'], 501);
        }
    }

    public function update(Request $request)
    {
        if($request->has('id_bio') && $request->has('alamat')  && $request->has('jk') 
        && $request->has('pendidikan')  && $request->has('usia') && $request->has('anggota_keluarga')
        && $request->has('status_pekerjaan') && $request->has('lama_beternak')) {
            $biodata = Biodata::findOrFail($request->input('id_bio'));
            // $biodata->id_user = $request->input('id_user');
            $biodata->alamat = $request->input('alamat');
            $biodata->jk = $request->input('jk');
            $biodata->pendidikan = $request->input('pendidikan');
            $biodata->usia = $request->input('usia');
            $biodata->anggota_keluarga = $request->input('anggota_keluarga');
            $biodata->status_pekerjaan = $request->input('status_pekerjaan');
            $biodata->lama_beternak = $request->input('lama_beternak');
            $biodata->updatedAt = NOW();
            $biodata->save();
            return response()->json(['data' => $biodata, 'message' => 'Berhasil di ubah'], 201);
        }else{
            return response()->json(['message' => 'Periksa Input anda'], 501);
        }
    }
}
