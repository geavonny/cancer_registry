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
            'message' =>'List Semua Rujukan',
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
                'message' => 'Semua Kolom Wajib Diisi!',
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
                    'message' => 'Rujukan Berhasil Disimpan!',
                    'data' => $rujukan
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rujukan Gagal Disimpan!',
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
                'message'=> 'Nomor Rekam Medis tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'List Semua No Rekam Medis',
                'data'    => $rujukan
            ], 200);
        }       
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rekam_medis'   => 'nullable',
            'ppk' => 'nullable',
            'tgl_ppk'   => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $rujukan = Rujukan::whereId($id)->update([
                'no_rekam_medis'   => $request->input('no_rekam_medis'),
                'ppk' => $request->input('ppk'),
                'tgl_ppk'   => $request->input('tgl_ppk'),
            ]);

            if ($rujukan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rujukan Berhasil Diupdate!',
                    'data' => $rujukan
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rujukan Gagal Diupdate!',
                ], 400);
            }

        }
    }

    public function destroy($id)
    {
        $rujukan = Rujukan::whereId($id)->first();
            $rujukan->delete();

        if ($rujukan) {
            return response()->json([
                'success' => true,
                'message' => 'Rujukan Berhasil Dihapus!',
            ], 200);
        }
    }
}