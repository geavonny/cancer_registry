<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use function Laravel\Prompts\error;

class LoginController extends Controller
{    
    //fungsi untuk menambahkan data user
    public function ceklogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua kolom required wajib diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $pengguna = Pengguna::where('username',$request->input('username'))->first();
            // dd(Hash::check($request->input('password'),$pengguna->password));
            // dd($pengguna);
            if($pengguna && Hash::check($request->input('password'),$pengguna->password)){
                // $token = $pengguna->createToken('cancer_registry')->plainTextToken();
                $token = Str::random(64);
                $expired_at = Carbon::now()->addHours(1);
                Token::create(
                    ['user_id'=>$pengguna->id,
                    'token'=>$token,
                    'expires_at'=>$expired_at,
                    ]                    
                );
                return response()->json([
                    'message'=> 'Login sukses',
                    'token'=> $token,
                    'expired_at'=>$expired_at,
                ]);
            } else{
                return response()->json([
                    'error'=> 'Unauthorized'
                ],401);
            }
        }
    }

    public function logout(Request $request){
        $token = $request->header('Authorization');
        if($token){
            Token::where('token', $token)->delete();
        } return response()->json([
            'message'=>'Berhasil keluar',
        ]);        
    }
}