<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::all();
        // $profile = 'test';    
        return response()->json([
            'success' => true,
            'message' =>'List Semua Profile Pasien',
            'data'    => $profile
        ], 200);
    }    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'nullable',
            'nik'   => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir'   => 'required',
            'jenis_kelamin' => 'required',
            'usia_terdiagnosis'   => 'nullable',
            'alamat' => 'nullable',
            'propinsi'   => 'nullable',
            'kabupaten' => 'nullable',
            'kecamatan'   => 'nullable',
            'desa' => 'nullable',
            'no_rekam_medis'   => 'nullable',
            'no_hp' => 'nullable',
            'no_hp2'   => 'nullable',
            'no_bpjs' => 'nullable',
            'bb'   => 'required',
            'tb' => 'required',
            'kesimpulan'   => 'nullable',
            'no_registrasi' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua kolom required wajib diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $profile = Profile::create([
                'nama_lengkap' => $request->input('nama_lengkap'),
                'nik'   => $request->input('nik'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir'   => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'usia_terdiagnosis'   => $request->input('usia_terdiagnosis'),
                'alamat' => $request->input('alamat'),
                'propinsi'   => $request->input('propinsi'),
                'kabupaten' => $request->input('kabupaten'),
                'kecamatan'   => $request->input('kecamatan'),
                'desa' => $request->input('desa'),
                'no_rekam_medis'   => $request->input('no_rekam_medis'),
                'no_hp' => $request->input('no_hp'),
                'no_hp2'   => $request->input('no_hp2'),
                'no_bpjs' => $request->input('no_bpjs'),
                'bb'   => $request->input('bb'),
                'tb' => $request->input('tb'),
                'kesimpulan'   => $request->input('kesimpulan'),
                'no_registrasi' => $request->input('no_registrasi')
            ]);

            if ($profile) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile pasien berhasil disimpan!',
                    'data' => $profile
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile pasien gagal disimpan!',
                ], 400);
            }

        }
    }
    
    public function show($no_rekam_medis = null)
    {
        $profile = Profile::where('no_rekam_medis',$no_rekam_medis)
                            // ->orWhere('no_registrasi',$no_registrasi)
                            ->get();
        // $profile = $no_registrasi;
       
        if($profile->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Nomor Rekam Medis pasien tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'Profile pasien berdasarkan No Rekam Medis',
                'data'    => $profile
            ], 200);
        }        
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama_lengkap' => 'nullable',
    //         'nik'   => 'nullable',
    //         'tempat_lahir' => 'nullable',
    //         'tanggal_lahir'   => 'nullable',
    //         'jenis_kelamin' => 'nullable',
    //         'usia_terdiagnosis'   => 'nullable',
    //         'alamat' => 'nullable',
    //         'propinsi'   => 'nullable',
    //         'kabupaten' => 'nullable',
    //         'kecamatan'   => 'nullable',
    //         'desa' => 'nullable',
    //         'no_rekam_medis'   => 'nullable',
    //         'no_hp' => 'nullable',
    //         'no_hp2'   => 'nullable',
    //         'no_bpjs' => 'nullable',
    //         'bb'   => 'nullable',
    //         'tb' => 'nullable',
    //         'kesimpulan'   => 'nullable',
    //         'no_registrasi' => 'nullable'
    //     ]);

    //     if ($validator->fails()) {

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Semua Kolom Wajib Diisi!',
    //             'data'   => $validator->errors()
    //         ],401);

    //     } else {

    //         $profile = Profile::whereId($id)->update([
    //             'nama_lengkap' => $request->input('nama_lengkap'),
    //             'nik' => $request->input('nik'),
    //             'tempat_lahir' => $request->input('tempat_lahir'),
    //             'tanggal_lahir'   => $request->input('tanggal_lahir'),
    //             'jenis_kelamin' => $request->input('jenis_kelamin'),
    //             'usia_terdiagnosis'   => $request->input('usia_terdiagnosis'),
    //             'alamat' => $request->input('alamat'),
    //             'propinsi'   => $request->input('propinsi'),
    //             'kabupaten' => $request->input('kabupaten'),
    //             'kecamatan'   => $request->input('kecamatan'),
    //             'desa' => $request->input('desa'),
    //             'no_rekam_medis'   => $request->input('no_rekam_medis'),
    //             'no_hp' => $request->input('no_hp'),
    //             'no_hp2'   => $request->input('no_hp2'),
    //             'no_bpjs' => $request->input('no_bpjs'),
    //             'bb'   => $request->input('bb'),
    //             'tb' => $request->input('tb'),
    //             'kesimpulan'   => $request->input('kesimpulan'),
    //             'no_registrasi' => $request->input('no_registrasi')
    //         ]);

    //         if ($profile) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Profile Berhasil Diupdate!',
    //                 'data' => $profile
    //             ], 201);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Profile Gagal Diupdate!',
    //             ], 400);
    //         }

    //     }
    // }    

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'nullable',
            'nik'   => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir'   => 'nullable',
            'jenis_kelamin' => 'nullable',
            'usia_terdiagnosis'   => 'nullable',
            'alamat' => 'nullable',
            'propinsi'   => 'nullable',
            'kabupaten' => 'nullable',
            'kecamatan'   => 'nullable',
            'desa' => 'nullable',
            'no_rekam_medis'   => 'nullable',
            'no_hp' => 'nullable',
            'no_hp2'   => 'nullable',
            'no_bpjs' => 'nullable',
            'bb'   => 'nullable',
            'tb' => 'nullable',
            'kesimpulan'   => 'nullable',
            'no_registrasi' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data'   => $validator->errors()
            ], 401);
        }

        // Ambil data lama dari database
        $existingProfile = Profile::find($id);

        if (!$existingProfile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile pasien tidak ditemukan!'
            ], 404);
        }

        // Gabungkan data lama dengan data baru
        $updatedData = array_merge(
            $existingProfile->toArray(),
            $request->only(array_keys($validator->getRules()))
        );

        // Update data ke database
        $profile = $existingProfile->update($updatedData);

        if ($profile) {
            return response()->json([
                'success' => true,
                'message' => 'Profile pasien berhasil diperbarui!',
                'data' => $updatedData
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile pasien gagal diperbarui!'
            ], 400);
        }
    }

    public function destroy($id)
    {
        $profile = Profile::whereId($id)->first();
            $profile->delete();

        if ($profile) {
            return response()->json([
                'success' => true,
                'message' => 'Profile pasien berhasil dihapus!',
            ], 200);
        }
    }
}