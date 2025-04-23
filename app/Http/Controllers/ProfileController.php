<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Histori;
use App\Models\Diagnosis;
use App\Models\Rujukan;
use App\Models\Rekam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //fungsi untuk membutuhkan token untuk akses API
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    //fungsi untuk menampilkan data profil seluruh pasien
    public function index(Request $reqtoken)
    {
        $token = $reqtoken ->header('Authorization');   
            if($token){
                $profile = Profile::all();
                // $profile = 'test';    
                return response()->json([
                'success' => true,
                'message' =>'List Semua Profile Pasien',
                'data'    => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }   
    }    

    //fungsi untuk menambahkan data profil pasien
    public function store(Request $request, $reqtoken)
    {
        $token = $reqtoken ->header('Authorization');
        if($token){
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required',
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
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }           
    }
    
    /*fungsi untuk mencari data profil pasien berdasarkan no rekam medis, 
    no registrasi dan id pasien*/
    public function show($no_rekam_medis = null, Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $profile = Profile::where('no_rekam_medis',$no_rekam_medis)
                            ->orWhere('no_registrasi',$no_rekam_medis)
                            ->orWhereRaw('LOWER(nama_lengkap) LIKE ?', [strtolower('%'.$no_rekam_medis.'%')])
                            ->get();
            // $profile = $no_registrasi;
        
            if($profile->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Profil pasien tidak ditemukan'
                ], 404);
            }else{
                return response()->json([
                    'success' => true,
                    'message' =>'Profile pasien',
                    'data'    => $profile
                ], 200);
            } 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }                 
    }

    //fungsi untuk update data profil pasien berdasarkan id pasien
    public function update(Request $request, $id, $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
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
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }   
        
    }

    //fungsi untuk menghapus seluruh data pasien berdasarkan no rekam medis
    public function destroy($no_rekam_medis, Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $profile = Profile::where('no_rekam_medis',$no_rekam_medis)->first();
                $profile->delete();
            $histori = Histori::where('no_rekam_medis',$no_rekam_medis)->first();
                $histori->delete();
            $diagnosis = Diagnosis::where('no_rekam_medis',$no_rekam_medis)->first();
                $diagnosis->delete();
            $rujukan = Rujukan::where('no_rekam_medis',$no_rekam_medis)->first();
                $rujukan->delete();
            $rekam = Rekam::where('no_rekam_medis',$no_rekam_medis)->first();
                $rekam->delete();    

            if ($profile && $histori && $rujukan && $rekam && $diagnosis) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile pasien berhasil dihapus!',
                ], 200);
            }            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }           
    }
}