<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RekamController extends Controller
{
    public function index()
    {
        $rekam = Rekam::all();
        // $rekam = 'test';    
        return response()->json([
            'success' => true,
            'message' =>'List Semua Rekam',
            'data'    => $rekam
        ], 200);
    }    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $rekam = Rekam::create([
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
                    'message' => 'Rekam Berhasil Disimpan!',
                    'data' => $rekam
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rekam Gagal Disimpan!',
                ], 400);
            }

        }
    }
    
    public function show($no_rekam_medis = null)
    {
        $rekam = Rekam::where('no_rekam_medis',$no_rekam_medis)
                            // ->orWhere('pemeriksaan_fisik_lainnya',$pemeriksaan_fisik_lainnya)
                            ->get();
        // $rekam = $pemeriksaan_fisik_lainnya;
       
        if($rekam->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Nomor Rekam Medis tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'Rekam dari No Rekam Medis',
                'data'    => $rekam
            ], 200);
        }        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $rekam = Rekam::whereId($id)->update([
                'no_rekam_medis' => $request->input('no_rekam_medis'),
                'tgl_kunjungan' => $request->input('tgl_kunjungan'),
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
                    'message' => 'Rekam Berhasil Diupdate!',
                    'data' => $rekam
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rekam Gagal Diupdate!',
                ], 400);
            }

        }
    }    

    public function destroy($id)
    {
        $rekam = Rekam::whereId($id)->first();
            $rekam->delete();

        if ($rekam) {
            return response()->json([
                'success' => true,
                'message' => 'Rekam Berhasil Dihapus!',
            ], 200);
        }
    }
}