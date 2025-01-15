<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    //fungsi untuk menampilkan data jadwal checkup seluruh pasien
    public function index()
    {
        $jadwal = Jadwal::all();    
        return response()->json([
            'success' => true,
            'message' =>'List Semua Jadwal',
            'data'    => $jadwal
        ], 200);
    }    

    //fungsi untuk menambahkan data jadwal checkup pasien
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rekam_medis' => 'required',
            'id_dokter' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua kolom required wajib diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $jadwal = Jadwal::create([
                'no_rekam_medis' => $request->input('no_rekam_medis'),
                'id_dokter'   => $request->input('id_dokter'),
                'tanggal'   => $request->input('tanggal'),
                'status'   => $request->input('status'),
            ]);

            if ($jadwal) {
                return response()->json([
                    'success' => true,
                    'message' => 'Jadwal berhasil disimpan!',
                    'data' => $jadwal
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal gagal disimpan!',
                ], 400);
            }
        }
    }
    
    /*fungsi untuk mencari data jadwal checkup berdasarkan no rekam medis pasien
     dan id jadwal checkup pasien*/
    public function show($no_rekam_medis = null)
    {
        $jadwal = Jadwal::where('no_rekam_medis',$no_rekam_medis)
                          ->orWhere('id',$no_rekam_medis)
                          ->get();
        // $jadwal = $no_registrasi;
       
        if($jadwal->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'Data Jadwal',
                'data'    => $jadwal
            ], 200);
        }        
    }

    //fungsi untuk update data jadwal checkup berdasarkan id jadwal checkup pasien
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_rekam_medis' => 'nullable',
            'id_dokter' => 'nullable',
            'tanggal' => 'nullable',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data'   => $validator->errors()
            ], 401);
        }

        // Ambil data lama dari database
        $existingJadwal = Jadwal::find($id);

        if (!$existingJadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan!'
            ], 404);
        }

        // Gabungkan data lama dengan data baru
        $updatedData = array_merge(
            $existingJadwal->toArray(),
            $request->only(array_keys($validator->getRules()))
        );

        // Update data ke database
        $jadwal = $existingJadwal->update($updatedData);

        if ($jadwal) {
            return response()->json([
                'success' => true,
                'message' => 'Data Jadwal berhasil diperbarui!',
                'data' => $updatedData
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Jadwal gagal diperbarui!'
            ], 400);
        }
    }

    //fungsi untuk menghapus data jadwal checkup berdasarkan id jadwal checkup pasien
    public function destroy($no_rekam_medis)
    {
        $jadwal = Jadwal::where('no_rekam_medis',$no_rekam_medis)->first();
            $jadwal->delete();   

        if ($jadwal) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dihapus!',
            ], 200);
        }
    }
}