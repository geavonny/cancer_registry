<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GejalaController extends Controller
{
    //fungsi untuk menampilkan data gejala pasien seluruhnya
    public function index(Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $gejala = Gejala::all();    
            return response()->json([
                'success' => true,
                'message' =>'List Semua Gejala',
                'data'    => $gejala
            ], 200);    
        }  else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }         
    }    

    //fungsi untuk menambahkan data gelaja pasien
    public function store(Request $request, $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $validator = Validator::make($request->all(), [
                'no_rekam_medis' => 'required',
                'gejala' => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);

            } else {

                $gejala = Gejala::create([
                    'no_rekam_medis' => $request->input('no_rekam_medis'),
                    'gejala'   => $request->input('gejala'),
                ]);

                if ($gejala) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Gejala berhasil disimpan!',
                        'data' => $gejala
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gejala gagal disimpan!',
                    ], 400);
                }
            }    
        }  else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }         
    }
    
    //fungsi untuk mencari data gejala pasien berdasarkan no rekam medis dan id pasien
    public function show($no_rekam_medis = null, Request $reqtoken) 
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $gejala = Gejala::where('no_rekam_medis',$no_rekam_medis)
                                ->orWhere('id',$no_rekam_medis)
                                ->get();
            // $gejala = $no_registrasi;
        
            if($gejala->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Data Gejala',
                    'data'    => $gejala
                ], 200);
            }            
        }  else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }         
    }

    //fungsi untuk update data gejala pasien berdasarkan id pasien
    public function update(Request $request, $id, $reqtoken) 
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            // Validasi input
            $validator = Validator::make($request->all(), [
                'no_rekam_medis' => 'nullable',
                'gejala' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 401);
            }

            // Ambil data lama dari database
            $existingGejala = Gejala::find($id);

            if (!$existingGejala) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gejala tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingGejala->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $gejala = $existingGejala->update($updatedData);

            if ($gejala) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Gejala berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gejala gagal diperbarui!'
                ], 400);
            }    
        }  else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }         
    }

    //fungsi untuk menghapus data gejala pasien berdasarkan no rekam medis
    public function destroy($no_rekam_medis, Request $reqtoken) 
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $gejala = Gejala::where('no_rekam_medis',$no_rekam_medis)->first();
                $gejala->delete();   

            if ($gejala) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gejala berhasil dihapus!',
                ], 200);
            }    
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }      
    }
}