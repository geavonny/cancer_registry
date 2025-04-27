<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HistoriController extends Controller
{
    //fungsi untuk menampilkan data histori seluruh pasien
    public function index()
    {  
            $histori = Histori::all();
            // $histori = 'test';    
            return response()->json([
                'success' => true,
                'message' =>'List Semua Histori Pasien',
                'data'    => $histori
            ], 200);            
    }

    //fungsi untuk menambahkan data histori pasien
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'nama_lengkap'   => 'required',
                'no_registrasi'   => 'required',
                'no_rekam_medis'   => 'nullable',
                'dasar_diagnosis' => 'nullable',
                'bb_lahir'   => 'required',
                'imunisasi' => 'required',
                'asi_eksklusif'   => 'required',
                'riwayat_keganasan_keluarga' => 'required',
                'ket_keganasan_keluarga'   => 'nullable',
                'tata_laksana' => 'nullable',
                'staging_stadium'   => 'nullable',
                'tgl_keluhan_pertama'   => 'required',
                'tgl_diagnosis' => 'required',
                'tgl_pertama_terapi'   => 'required',
                'status_validasi' => 'required',
                'nama_unit'   => 'nullable',
            ]);
    
            if ($validator->fails()) {
    
                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);
    
            } else {
    
                $histori = Histori::create([
                    'nama_lengkap'   => $request->input('nama_lengkap'),
                    'no_registrasi'   => $request->input('no_registrasi'),
                    'no_rekam_medis'   => $request->input('no_rekam_medis'),
                    'dasar_diagnosis' => $request->input('dasar_diagnosis'),
                    'bb_lahir'   => $request->input('bb_lahir'),
                    'imunisasi' => $request->input('imunisasi'),
                    'asi_eksklusif'   => $request->input('asi_eksklusif'),
                    'riwayat_keganasan_keluarga' => $request->input('riwayat_keganasan_keluarga'),
                    'ket_keganasan_keluarga'   => $request->input('ket_keganasan_keluarga'),
                    'tata_laksana' => $request->input('tata_laksana'),
                    'staging_stadium'   => $request->input('staging_stadium'),
                    'tgl_keluhan_pertama'   => $request->input('tgl_keluhan_pertama'),
                    'tgl_diagnosis' => $request->input('tgl_diagnosis'),
                    'tgl_pertama_terapi'   => $request->input('tgl_pertama_terapi'),
                    'status_validasi' => $request->input('status_validasi'),
                    'nama_unit'   => $request->input('nama_unit')
                ]);
    
                if ($histori) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Histori pasien berhasil disimpan!',
                        'data' => $histori
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Histori pasien gagal disimpan!',
                    ], 400);
                }
            }       
    }

    //fungsi untuk mencari data histori pasien berdasarkan no rekam medis dan id pasien
    public function show($no_rekam_medis = null)
    {
            $histori = Histori::where('no_rekam_medis',$no_rekam_medis)
                            ->orWhere('no_registrasi',$no_rekam_medis)
                            ->orWhere('nama_lengkap',$no_rekam_medis)
                            ->get();
            // $histori = $no_rekam_medis;
        
            if($histori->isEmpty()){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Histori pasien tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Histori pasien',
                    'data'    => $histori
                ], 200);
            }                
    }

    //fungsi untuk update data histori pasien berdasarkan id pasien
    public function update(Request $request, $id)
    {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'no_rekam_medis'   => 'nullable',
                'dasar_diagnosis' => 'nullable',
                'bb_lahir'   => 'nullable',
                'imunisasi' => 'nullable',
                'asi_eksklusif'   => 'nullable',
                'riwayat_keganasan_keluarga' => 'nullable',
                'ket_keganasan_keluarga'   => 'nullable',
                'tata_laksana' => 'nullable',
                'staging_stadium'   => 'nullable',
                'tgl_keluhan_pertama'   => 'nullable',
                'tgl_diagnosis' => 'nullable',
                'tgl_pertama_terapi'   => 'nullable',
                'status_validasi' => 'nullable',
                'nama_unit'   => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 401);
            }

            // Ambil data lama dari database
            $existingHistori = Histori::find($id);

            if (!$existingHistori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Histori pasien tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingHistori->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $histori = $existingHistori->update($updatedData);

            if ($histori) {
                return response()->json([
                    'success' => true,
                    'message' => 'Histori pasien berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Histori pasien gagal diperbarui!'
                ], 400);
            }
    }

    //fungsi untuk menghapus data histori pasien berdasarkan id pasien
    public function destroy($no_rekam_medis)
    {
            $histori = Histori::where($no_rekam_medis)->first();
            $histori->delete();

            if ($histori) {
                return response()->json([
                    'success' => true,
                    'message' => 'Histori pasien berhasil dihapus!',
                ], 200);
            }        
    }
}