<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnosis = Diagnosis::all();
        // $diagnosis = 'test';    
        return response()->json([
            'success' => true,
            'message' =>'List Semua Diagnosis',
            'data'    => $diagnosis
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rekam_medis'   => 'nullable',
            'kode_subgroup' => 'nullable',
            'subgroup'   => 'nullable',
            'kode_morfologi' => 'nullable',
            'morfologi'   => 'nullable',
            'kode_topografi' => 'nullable',
            'topografi'   => 'nullable',
            'literalitas' => 'nullable',
            'tgl_pertama_konsultasi'   => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $diagnosis = Diagnosis::create([
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
                    'message' => 'Diagnosis Berhasil Disimpan!',
                    'data' => $diagnosis
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Diagnosis Gagal Disimpan!',
                ], 400);
            }

        }
    }

    public function show($no_rekam_medis = null)
    {
        $diagnosis = Diagnosis::where('no_rekam_medis',$no_rekam_medis)
                                // ->orWhere('no_registrasi',$no_registrasi)
                                ->get();
        // $diagnosis = Diagnosis::when($no_rekam_medis, function ($query, $no_rekam_medis) {
        //                             return $query->where('no_rekam_medis', $no_rekam_medis);
        //                             })
        //                         ->when($no_registrasi, function ($query, $no_registrasi) {
        //                             return $query->orWhere('no_registrasi', $no_registrasi);
        //                             })
        //                         ->first();
       
        if($diagnosis->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Nomor Rekam Medis tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'No Rekam Medis Diagnosis',
                'data'    => $diagnosis
            ], 200);
        }        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rekam_medis'   => 'nullable',
            'kode_subgroup' => 'nullable',
            'subgroup'   => 'nullable',
            'kode_morfologi' => 'nullable',
            'morfologi'   => 'nullable',
            'kode_topografi' => 'nullable',
            'topografi'   => 'nullable',
            'literalitas' => 'nullable',
            'tgl_pertama_konsultasi'   => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $diagnosis = Diagnosis::whereId($id)->update([
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
                    'message' => 'Diagnosis Berhasil Diupdate!',
                    'data' => $diagnosis
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Diagnosis Gagal Diupdate!',
                ], 400);
            }

        }
    }

    public function destroy($id)
    {
        $diagnosis = Diagnosis::whereId($id)->first();
            $diagnosis->delete();

        if ($diagnosis) {
            return response()->json([
                'success' => true,
                'message' => 'Diagnosis Berhasil Dihapus!',
            ], 200);
        }
    }
}