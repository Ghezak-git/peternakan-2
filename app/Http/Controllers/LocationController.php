<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\User;

class LocationController extends Controller
{
    public function index($id)
    {
        $location = Location::where('id_user', '=', $id)->first();
        if($location != null){
            return response()->json(['data' => $location], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }

    public function store(Request $request)
    {
        $cekuser = User::where('id_user', '=', $request->input('id_user'))->first();
        $cekloc = Location::where('id_user', '=', $request->input('id_user'))->first();
        if($cekuser == null){
            return response()->json(['message' => 'ID ini tidak terdaftar'], 404);
        }elseif($cekloc != null){
            return response()->json(['message' => 'Lokasi sudah dibuat'], 404);
        }
        if($request->has('id_user') && $request->has('island')  && $request->has('province') 
        && $request->has('city')  && $request->has('district') && $request->has('latitude')
        && $request->has('longtitude') && $request->has('altitude')) {
            $location = new Location(); 
            $location->id_user = $request->input('id_user');
            $location->island = $request->input('island');
            $location->province = $request->input('province');
            $location->city = $request->input('city');
            $location->district = $request->input('district');
            $location->latitude = $request->input('latitude');
            $location->longtitude = $request->input('longtitude');
            $location->altitude = $request->input('altitude');
            $location->createdAt = NOW();
            $location->save();
            return response()->json(['data' => $location, 'message' => 'Berhasil Disimpan'], 201);
        }else{
            return response()->json(['message' => 'Periksa Input anda'], 501);
        }
    }

    public function update(Request $request)
    {
        if($request->has('location_id') && $request->has('island')  && $request->has('province') 
        && $request->has('city')  && $request->has('district') && $request->has('latitude')
        && $request->has('longtitude') && $request->has('altitude')) {
            $location = Location::findOrFail($request->input('location_id'));
            // $location->id_user = $request->input('id_user');
            $location->island = $request->input('island');
            $location->province = $request->input('province');
            $location->city = $request->input('city');
            $location->district = $request->input('district');
            $location->latitude = $request->input('latitude');
            $location->longtitude = $request->input('longtitude');
            $location->altitude = $request->input('altitude');
            $location->updatedAt = NOW();
            $location->save();
            return response()->json(['data' => $location, 'message' => 'Berhasil di ubah'], 201);
        }else{
            return response()->json(['message' => 'Periksa Input anda'], 501);
        }
    }
}
