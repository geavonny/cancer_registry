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
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);

            } else {

                $pengguna = Pengguna::where('email',$request->input('email'))
                                        ->orWhere('nik',$request->input('nik'))
                                        ->orWhere('username',$request->input('username'))
                                        ->first();
                // dd(Hash::check($request->input('password'),$pengguna->password));
                // dd($pengguna);
                if($pengguna && Hash::check($request->input('password'),$pengguna->password)){
                    // $token = $pengguna->createToken('cancer_registry')->plainTextToken();
                    $existingToken = Token::where('user_id',$pengguna->id)->first();

                    if($existingToken){
                        if(Carbon::now()->greaterThan($existingToken->expired_at)){
                            $existingToken->delete();
                        } else {
                            return response()->json([
                                'message'=> 'Token masih berlaku, Login sukses!',
                                'user_id'=> $pengguna->id,
                                'role'=> $pengguna->level,
                                'token'=> $existingToken,
                            ]);
                        }
                    }                
                    
                    $token = Str::random(64);
                    $expired_at = Carbon::now()->addHours(24);
                    Token::create(
                        [
                        'user_id'=>$pengguna->id,
                        'token'=>$token,
                        'expired_at'=>$expired_at,
                        ]                    
                    );
                    return response()->json([
                        'message'=> 'Login sukses',
                        'user_id'=> $pengguna->id,
                        'role'=> $pengguna->level,
                        'token'=> $token,
                        // 'expired_at'=>$expired_at,
                        'expired_at' => Carbon::parse($expired_at)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    ]);
                } else{
                    return response()->json([
                        'error'=> 'Unauthorized'
                    ],401);
                }
            }    

        
    }

    public function logout(Request $request)
    {
        $token = $request->header('Authorization');
        if($token){
            Token::where('token', $token)->delete();
        } return response()->json([
            'message'=>'Berhasil keluar',
        ]);        
    }
}