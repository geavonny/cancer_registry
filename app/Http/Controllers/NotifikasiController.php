<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    //fungsi untuk menampilkan data profil seluruh pasien
    public function notifikasi(Request $reqtoken)
    {
        $token = $reqtoken->header('Authorization');
        if($token){
            $startDate = Carbon::now()->startOfDay();
            $endDate = Carbon::now()->addDays(3)->endOfDay();

            // Query database
            $notifikasi = Jadwal::whereBetween('tanggal', [$startDate, $endDate])->get();

            if ($notifikasi->isNotEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notifikasi anda berhasil!',
                    'data1' => $notifikasi,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan',
                ], 400);
            }    
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 400);
        }   
        
    }
}