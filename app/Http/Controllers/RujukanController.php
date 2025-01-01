<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RujukanController extends Controller
{
    public function index()
    {
        $rujukan = Rujukan::all();
        // $rujukan = 'test';    
        return response()->json([
            'success' => true,
            'message' =>'List Semua Rujukan Pasien',
            'data'    => $rujukan
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rekam_medis'   => 'nullable',
            'ppk' => 'nullable',
            'tgl_ppk'   => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Kolom required wajib diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $rujukan = Rujukan::create([
                'no_rekam_medis'   => $request->input('no_rekam_medis'),
                'ppk' => $request->input('ppk'),
                'tgl_ppk'   => $request->input('tgl_ppk'),
            ]);

            if ($rujukan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rujukan pasien berhasil disimpan!',
                    'data' => $rujukan
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rujukan pasien gagal disimpan!',
                ], 400);
            }
        }
    }

    public function show($no_rekam_medis = null)
    {
        $rujukan = Rujukan::where('no_rekam_medis',$no_rekam_medis)->get();
        
        if($rujukan->isEmpty()){
            return response()->json([
                'success'=> false,
                'message'=> 'Nomor Rekam Medis pasien tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'Rujukan pasien berdasarkan No Rekam Medis',
                'data'    => $rujukan
            ], 200);
        }       
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'no_rekam_medis'   => 'nullable',
    //         'ppk' => 'nullable',
    //         'tgl_ppk'   => 'required',
    //     ]);

    //     if ($validator->fails()) {

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Semua Kolom Wajib Diisi!',
    //             'data'   => $validator->errors()
    //         ],401);

    //     } else {

    //         $rujukan = Rujukan::whereId($id)->update([
    //             'no_rekam_medis'   => $request->input('no_rekam_medis'),
    //             'ppk' => $request->input('ppk'),
    //             'tgl_ppk'   => $request->input('tgl_ppk'),
    //         ]);

    //         if ($rujukan) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Rujukan Berhasil Diupdate!',
    //                 'data' => $rujukan
    //             ], 201);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Rujukan Gagal Diupdate!',
    //             ], 400);
    //         }

    //     }
    // }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_rekam_medis'   => 'nullable',
            'ppk' => 'nullable',
            'tgl_ppk' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data'   => $validator->errors()
            ], 401);
        }

        // Ambil data lama dari database
        $existingRujukan = Rujukan::find($id);

        if (!$existingRujukan) {
            return response()->json([
                'success' => false,
                'message' => 'Rujukan pasien tidak ditemukan!'
            ], 404);
        }

        // Gabungkan data lama dengan data baru
        $updatedData = array_merge(
            $existingRujukan->toArray(),
            $request->only(array_keys($validator->getRules()))
        );

        // Update data ke database
        $rujukan = $existingRujukan->update($updatedData);

        if ($rujukan) {
            return response()->json([
                'success' => true,
                'message' => 'Rujukan pasien berhasil diperbarui!',
                'data' => $updatedData
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Rujukan pasien gagal diperbarui!'
            ], 400);
        }
    }

    public function destroy($id)
    {
        $rujukan = Rujukan::whereId($id)->first();
            $rujukan->delete();

        if ($rujukan) {
            return response()->json([
                'success' => true,
                'message' => 'Rujukan pasien berhasil dihapus!',
            ], 200);
        }
    }
}