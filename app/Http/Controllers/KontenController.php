<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KontenController extends Controller
{
    //fungsi untuk menampilkan seluruh data konten
    public function index(Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $konten = Konten::all();    
            return response()->json([
                'success' => true,
                'message' =>'List Semua Konten',
                'data'    => $konten
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }          
    }    

    //fungsi untuk menambahkan data konten
    public function store(Request $request, $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'sumber' => 'required',
                'embed' => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);

            } else {

                $konten = Konten::create([
                    'judul' => $request->input('judul'),
                    'sumber'   => $request->input('sumber'),
                    'embed' => $request->input('embed'),
                ]);

                if ($konten) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Konten berhasil disimpan!',
                        'data' => $konten
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Konten gagal disimpan!',
                    ], 400);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }   
        
    }
    
    //fungsi untuk mencari data konten berdasarkan judul konten
    public function show($judul = null, Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $konten = Konten::where('judul',$judul)
                                ->get();
            // $konten = $no_registrasi;
        
            if($konten->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Data Konten',
                    'data'    => $konten
                ], 200);
            } 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }   
               
    }

    //fungsi untuk update data konten berdasarkan id konten
    public function update(Request $request, $id, $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            // Validasi input
            $validator = Validator::make($request->all(), [
                'judul' => 'nullable',
                'sumber' => 'nullable',
                'embed' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 401);
            }

            // Ambil data lama dari database
            $existingKonten = Konten::find($id);

            if (!$existingKonten) {
                return response()->json([
                    'success' => false,
                    'message' => 'Konten tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingKonten->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $konten = $existingKonten->update($updatedData);

            if ($konten) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data konten berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data konten gagal diperbarui!'
                ], 400);
            }    
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }           
    }

    //fungsi untuk menghapus data konten berdasarkan id konten
    public function destroy($id, Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $konten = Konten::where('id',$id)->first();
                $konten->delete();   

            if ($konten) {
                return response()->json([
                    'success' => true,
                    'message' => 'Konten berhasil dihapus!',
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