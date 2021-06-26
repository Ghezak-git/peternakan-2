<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Biodata;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ((Auth::attempt($credentials))) {
            $user = $this->guard()->user();
            $api_token = Str::random(60);
            $user->api_token = $api_token;
            $user->save();
            
            $cekgmail = Biodata::where('id_user' , '=' , $user['id_user'])->first();
            if($cekgmail > 0){
                $user->login_attemp = $user->login_attemp + 1;
                $user->save();
                return response()->json([
                    'success' => 'ya',
                    'user' => $user->toArray(),
                    'bio' => $cekgmail->toArray(),
                ]);
            }else{
                return response()->json([
                    'success' => 'ya',
                    'user' => $user->toArray(),
                    'bio' => null,
                ]);
            }
        }
        return response()->json([
            'success' => 'tidak',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
            return response()->json(['data' => 'User logged out.'], 200);
        }
        return response()->json(['state' => 0, 'message' => 'Unauthenticated'], 401);
    }

    // public function checkAuth(Request $request)
    // {
    //     $user = Auth::guard('api')->user();
    //     if ($user && $user->posisi) {
    //         return response()->json(['state' => 1], 200);
    //     }
    //     $user->api_token = null;
    //     $user->save();
    //     return response()->json(['state' => 0], 401);
    // }

    // public function forgetpw(Request $request){
    //     $cekgmail = User::where('email' , '=' , $request->input('email'))->first();
    //     if(!$cekgmail){
    //         return response()->json(['message' => 'Sorry This Email Not Registered In Our System'], 500);
    //     }else{
    //         $changepw = Str::random(10);
    //         $cekgmail->password = bcrypt($changepw);
    //         $to_email = $cekgmail->email;
    //         $to_name = $cekgmail->nama_user;
    //         $data = array('name'=> $to_name 
    //         , "body" => "Your New Password is : ".$changepw);
                
    //         Mail::send('forgetemail', $data, function($message) use ($to_name, $to_email) {
    //             $message->to($to_email, $to_name)
    //                     ->subject('Your New Password');
    //             $message->from('bot@cisa.id','Your New Password');
    //         });
    //         $cekgmail->save();
    //         return response()->json(['message' => 'Check Your Gmail'], 200);
    //     }
    // }
}
