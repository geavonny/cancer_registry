<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RekamController extends Controller
{
    //fungsi untuk menampilkan data rekam medis seluruh pasien
    public function index()
    {
            $rekam = Rekam::all();
            // $rekam = 'test';    
            return response()->json([
                'success' => true,
                'message' =>'List Semua Rekam Medis Pasien',
                'data'    => $rekam
            ], 200);
                 
    }    

    //fungsi untuk menambahkan data rekam medis pasien
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required',
                'no_registrasi' => 'required',
                'no_rekam_medis' => 'required',
                'tgl_kunjungan'   => 'nullable',
                'keluhan_utama' => 'nullable',
                'siklus_ke'   => 'nullable',
                'komplikasi_penyakit_dasar' => 'nullable',
                'komplikasi_kemoterapi'   => 'nullable',
                'infeksi_kemo' => 'nullable',
                'non_infeksi_kemo'   => 'nullable',
                'evaluasi_pengobatan' => 'nullable',
                'tgl_evaluasi'   => 'nullable',
                'evaluasi_pengobatan_lain' => 'nullable',
                'keluhan_tujuan_lain'   => 'nullable',
                'pemeriksaan_fisik' => 'nullable',
                'ukuran_tumor'   => 'nullable',
                'lokasi_limfadenompati' => 'nullable',
                'besar_hepar'   => 'nullable',
                'besar_lien' => 'nullable',
                'schuffner'   => 'nullable',
                'pemeriksaan_fisik_lainnya' => 'nullable',
                'tgl_periksa_lab' => 'nullable',
                'hemoglobin' => 'nullable',
                'leukosit' => 'nullable',
                'trombosit' => 'nullable',
                'blast' => 'nullable',
                'tumor_marker' => 'nullable',
                'limfoblas' => 'nullable',
                'tambahan_infeksi' => 'nullable',
                'tambahan_non_infeksi' => 'nullable',
                'plan' => 'nullable',
                'plan_lainnya' => 'nullable'
            ]);
    
            if ($validator->fails()) {
    
                return response()->json([
                    'success' => false,
                    'message' => 'Kolom required wajib diisi!',
                    'data'   => $validator->errors()
                ],401);
    
            } else {
    
                $rekam = Rekam::create([
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'no_registrasi' => $request->input('no_registrasi'),
                    'no_rekam_medis' => $request->input('no_rekam_medis'),
                    'tgl_kunjungan'   => $request->input('tgl_kunjungan'),
                    'keluhan_utama' => $request->input('keluhan_utama'),
                    'siklus_ke'   => $request->input('siklus_ke'),
                    'komplikasi_penyakit_dasar' => $request->input('komplikasi_penyakit_dasar'),
                    'komplikasi_kemoterapi'   => $request->input('komplikasi_kemoterapi'),
                    'infeksi_kemo' => $request->input('infeksi_kemo'),
                    'non_infeksi_kemo'   => $request->input('non_infeksi_kemo'),
                    'evaluasi_pengobatan' => $request->input('evaluasi_pengobatan'),
                    'tgl_evaluasi'   => $request->input('tgl_evaluasi'),
                    'evaluasi_pengobatan_lain' => $request->input('evaluasi_pengobatan_lain'),
                    'keluhan_tujuan_lain'   => $request->input('keluhan_tujuan_lain'),
                    'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik'),
                    'ukuran_tumor'   => $request->input('ukuran_tumor'),
                    'lokasi_limfadenompati' => $request->input('lokasi_limfadenompati'),
                    'besar_hepar'   => $request->input('besar_hepar'),
                    'besar_lien' => $request->input('besar_lien'),
                    'schuffner'   => $request->input('schuffner'),
                    'pemeriksaan_fisik_lainnya' => $request->input('pemeriksaan_fisik_lainnya'),
                    'tgl_periksa_lab' => $request->input('tgl_periksa_lab'),
                    'hemoglobin' => $request->input('hemoglobin'),
                    'leukosit' => $request->input('leukosit'),
                    'trombosit' => $request->input('trombosit'),
                    'blast' => $request->input('blast'),
                    'tumor_marker' => $request->input('tumor_marker'),
                    'limfoblas' => $request->input('limfoblas'),
                    'tambahan_infeksi' => $request->input('tambahan_infeksi'),
                    'tambahan_non_infeksi' => $request->input('tambahan_non_infeksi'),
                    'plan' => $request->input('plan'),
                    'plan_lainnya' => $request->input('plan_lainnya')
                ]);
    
                if ($rekam) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Rekam medis pasien berhasil disimpan!',
                        'data' => $rekam
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Rekam medis pasien gagal disimpan!',
                    ], 400);
                }
    
            }
                
    }
    
    //fungsi untuk mencari data rekam medis pasien berdasarkan no rekam medis dan id pasien
    public function show($no_rekam_medis = null)
    {
            $rekam = Rekam::where('no_rekam_medis',$no_rekam_medis)
                            ->orWhere('no_registrasi',$no_rekam_medis)
                            ->orWhere('nama_lengkap',$no_rekam_medis)
                            ->get();
            // $rekam = $pemeriksaan_fisik_lainnya;
        
            if($rekam->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Rekam medis pasien tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Rekam medis pasien',
                    'data'    => $rekam
                ], 200);
            }
                        
    }
    
    //fungsi untuk update data rekam medis pasien berdasarkan id pasien
    public function update(Request $request, $id)
    {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'nullable',
                'no_registrasi' => 'nullable',
                'no_rekam_medis' => 'nullable',
                'tgl_kunjungan'   => 'nullable',
                'keluhan_utama' => 'nullable',
                'siklus_ke'   => 'nullable',
                'komplikasi_penyakit_dasar' => 'nullable',
                'komplikasi_kemoterapi'   => 'nullable',
                'infeksi_kemo' => 'nullable',
                'non_infeksi_kemo'   => 'nullable',
                'evaluasi_pengobatan' => 'nullable',
                'tgl_evaluasi'   => 'nullable',
                'evaluasi_pengobatan_lain' => 'nullable',
                'keluhan_tujuan_lain'   => 'nullable',
                'pemeriksaan_fisik' => 'nullable',
                'ukuran_tumor'   => 'nullable',
                'lokasi_limfadenompati' => 'nullable',
                'besar_hepar'   => 'nullable',
                'besar_lien' => 'nullable',
                'schuffner'   => 'nullable',
                'pemeriksaan_fisik_lainnya' => 'nullable',
                'tgl_periksa_lab' => 'nullable',
                'hemoglobin' => 'nullable',
                'leukosit' => 'nullable',
                'trombosit' => 'nullable',
                'blast' => 'nullable',
                'tumor_marker' => 'nullable',
                'limfoblas' => 'nullable',
                'tambahan_infeksi' => 'nullable',
                'tambahan_non_infeksi' => 'nullable',
                'plan' => 'nullable',
                'plan_lainnya' => 'nullable'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal!',
                    'data'   => $validator->errors()
                ], 401);
            }

            // Ambil data lama dari database
            $existingRekam = Rekam::find($id);

            if (!$existingRekam) {
                return response()->json([
                    'success' => false,
                    'message' => 'Rekam Medis pasien tidak ditemukan!'
                ], 404);
            }

            // Gabungkan data lama dengan data baru
            $updatedData = array_merge(
                $existingRekam->toArray(),
                $request->only(array_keys($validator->getRules()))
            );

            // Update data ke database
            $rekam = $existingRekam->update($updatedData);

            if ($rekam) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rekam Medis pasien berhasil diperbarui!',
                    'data' => $updatedData
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rekam Medis pasien gagal diperbarui!'
                ], 400);
            }
                
    }

    //fungsi untuk menghapus data rekam medis pasien berdasarkan no rekam medis pasien
    public function destroy($no_rekam_medis)
    {
            $rekam = Rekam::where('no_rekam_medis',$no_rekam_medis)->first();
            $rekam->delete();

            if ($rekam) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rekam medis pasien berhasil dihapus!',
                ], 200);
            }
                 
    }
}