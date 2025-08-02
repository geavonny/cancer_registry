<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{
    //fungsi untuk menampilkan data diagnosis seluruh pasien
    public function index() 
    {
            $diagnosis = Diagnosis::all();
            // $diagnosis = 'test';    
            return response()->json([
                'success' => true,
                'message' =>'List Semua Diagnosis Pasien',
                'data'    => $diagnosis
            ], 200);     
    }

    //fungsi untuk menambahkan data diagnosis pasien
    public function store(Request $request) 
    {
            $validator = Validator::make($request->all(), [
                'nama_lengkap'   => 'required',
                'no_registrasi'   => 'required',
                'no_rekam_medis'   => 'nullable',
                'kode_subgroup' => 'nullable',
                'subgroup'   => 'nullable',
                'kode_morfologi' => 'nullable',
                'morfologi'   => 'nullable',
                'kode_topografi' => 'nullable',
                'topografi'   => 'nullable',
                'literalitas' => 'nullable',
                'tgl_pertama_konsultasi'   => 'required'
            ]);
    
            if ($validator->fails()) {
    
                return response()->json([
                    'success' => false,
                    'message' => 'Semua kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],422);
    
            } else {
    
                $diagnosis = Diagnosis::create([
                    'nama_lengkap'   => $request->input('nama_lengkap'),
                    'no_registrasi'   => $request->input('no_registrasi'),
                    'no_rekam_medis'   => $request->input('no_rekam_medis'),
                    'kode_subgroup' => $request->input('kode_subgroup'),
                    'subgroup'   => $request->input('subgroup'),
                    'kode_morfologi' => $request->input('kode_morfologi'),
                    'morfologi'   => $request->input('morfologi'),
                    'kode_topografi' => $request->input('kode_topografi'),
                    'topografi'   => $request->input('topografi'),
                    'literalitas' => $request->input('literalitas'),
                    'tgl_pertama_konsultasi'   => $request->input('tgl_pertama_konsultasi')
                ]);
    
                if ($diagnosis) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Diagnosis pasien berhasil disimpan!',
                        'data' => $diagnosis
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Diagnosis pasien gagal disimpan!',
                    ], 400);
                }
    
            }              
    }

    //fungsi untuk mencari data diagnosis pasien berdasarkan no rekam medis dan id
    public function show($no_rekam_medis = null) 
    {  
            $diagnosis = Diagnosis::where('no_rekam_medis',$no_rekam_medis)
                                ->orWhere('no_registrasi',$no_rekam_medis)
                                ->orWhere('nama_lengkap',$no_rekam_medis)
                                ->get();
            if($diagnosis->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Diagnosis pasien tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Diagnosis pasien',
                    'data'    => $diagnosis
                ], 200);
            }                       
    }

    //fungsi untuk update data diagnosis pasien
    public function update(Request $request, $id) 
    {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_lengkap'   => 'nullable',
                'no_registrasi'   => 'nullable',
                'no_rekam_medis'   => 'nullable',
                'kode_subgroup' => 'nullable',
                'subgroup'   => 'nullable',
                'kode_morfologi' => 'nullable',
                'morfologi'   => 'nullable',
                'kode_topografi' => 'nullable',
                'topografi'   => 'nullable',
                'literalitas' => 'nullable',
                'tgl_pertama_konsultasi'   => 'nullable'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 422);
            }

            // Ambil data lama dari database
            $existingDiagnosis = Diagnosis::find($id);

            if (!$existingDiagnosis) {
                return response()->json([
                    'success' => false,
                    'message' => 'Diagnosis pasien tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingDiagnosis->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $diagnosis = $existingDiagnosis->update($updatedData);

            if ($diagnosis) {
                return response()->json([
                    'success' => true,
                    'message' => 'Diagnosis pasien berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Diagnosis pasien gagal diperbarui!'
                ], 400);
            }                
    }

    // fungsi untuk menghapus data diagnosis pasien
    public function destroy($no_rekam_medis) 
    {
            $diagnosis = Diagnosis::where('no_rekam_medis',$no_rekam_medis)->first();
            $diagnosis->delete();

            if ($diagnosis) {
                return response()->json([
                    'success' => true,
                    'message' => 'Diagnosis pasien berhasil dihapus!',
                ], 200);
            }        
    }
}