<?php

namespace App\Imports;

use App\Models\ImportRekmed;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class RekmedImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return ImportRekmed|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportRekmed::where('nama_lengkap', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new ImportRekmed([
           'nama_lengkap'   => $row[0],
           'no_registrasi'    => $row[1], 
           'no_rekam_medis' => $row[2],
           'tgl_kunjungan' => $row[3],
           'keluhan_utama' => $row[4],
           'siklus_ke' => $row[5],
           'komplikasi_penyakit_dasar' => $row[6],
           'komplikasi_kemoterapi' => $row[7],
           'infeksi_kemo' => $row[8],
           'non_infeksi_kemo' => $row[9],
           'evaluasi_pengobatan' => $row[10],
           'tgl_evaluasi' => $row[11],
           'evaluasi_pengobatan_lain' => $row[12],
           'keluhan_tujuan_lain' => $row[13],
           'pemeriksaan_fisik' => $row[14],
           'ukuran_tumor' => $row[15],
           'lokasi_limfadenompati' => $row[16],
           'besar_hepar' => $row[17],
           'besar_lien' => $row[18],
           'schuffner' => $row[19],
           'pemeriksaan_fisik_lainnya' => $row[20],
           'tgl_periksa_lab' => $row[21],
           'hemoglobin' => $row[22],
           'leukosit' => $row[23],
           'trombosit' => $row[24],
           'blast' => $row[25],
           'tumor_marker' => $row[26],
           'limfoblas' => $row[27],
           'tambahan_infeksi' => $row[28],
           'tambahan_non_infeksi' => $row[29],
           'plan' => $row[30],
           'plan_lainnya' => $row[31],
        ]);
    }
}
