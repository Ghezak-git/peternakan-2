<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function user(){
        $user = User::get();
        if($user != null){
            return response()->json(['data' => $user], 200);
        }else{
            return response()->json(['data' => null], 404);
        }
    }
}
