<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    //fungsi untuk menampilkan seluruh data user
    public function index()
    {
            $pengguna = Pengguna::all();    
            return response()->json([
                'success' => true,
                'message' =>'List Semua User',
                'data'    => $pengguna
            ], 200);     
    }    

    //fungsi untuk menambahkan data user
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required',
                'username' => 'required',
                'password' => 'required',
                'email' => 'required',
                'nik'   => 'required',
                'level' => 'required'
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);

            } else {

                $pengguna = Pengguna::create([
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'username' => $request->input('username'),
                    'password'   => Hash::make($request->input('password')),
                    'email' => $request->input('email'),
                    'nik'   => $request->input('nik'),
                    'nip'   => $request->input('nip'),
                    'level' => $request->input('level'),
                ]);

                if ($pengguna) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User berhasil disimpan!',
                        'data' => $pengguna
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'User gagal disimpan!',
                    ], 400);
                }
            }      
    }
    
    //fungsi untuk mencari data user berdasarkan id user
    public function show($id = null)
    {
            $pengguna = Pengguna::where('id',$id)
                                // ->orWhere('no_registrasi',$username)
                                ->get();
            // $pengguna = $no_registrasi;
        
            if($pengguna->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Data User berdasarkan username',
                    'data'    => $pengguna
                ], 200);
            }                
    }

    //fungsi untuk update data user berdasarkan id user
    public function update(Request $request, $id)
    {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'nullable',
                'username' => 'nullable',
                'password' => 'nullable',
                'email' => 'nullable',
                'nik'   => 'nullable',
                'nip'   => 'nullable',
                'level' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 401);
            }

            // Ambil data lama dari database
            $existingPengguna = Pengguna::find($id);

            if (!$existingPengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingPengguna->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $pengguna = $existingPengguna->update($updatedData);

            if ($pengguna) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data User berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data User gagal diperbarui!'
                ], 400);
            }       
    }

    //fungsi untuk menghapus data user berdasarkan id user
    public function destroy($id)
    {
            $pengguna = Pengguna::where('id',$id)->first();
                $pengguna->delete();   

            if ($pengguna) {
                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil dihapus!',
                ], 200);
            }        
    }
}