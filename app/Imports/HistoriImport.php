<?php

namespace App\Imports;

use App\Models\ImportHistori;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class HistoriImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return ImportHistori|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportHistori::where('nama_lengkap', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new ImportHistori([
           'nama_lengkap'   => $row[0],
           'no_registrasi'    => $row[1], 
           'no_rekam_medis' => $row[2],
           'dasar_diagnosis' => $row[3],
           'bb_lahir' => $row[4],
           'imunisasi' => $row[5],
           'asi_eksklusif' => $row[6],
           'riwayat_keganasan_keluarga' => $row[7],
           'ket_keganasan_keluarga' => $row[8],
           'tata_laksana' => $row[9],
           'staging_stadium' => $row[10],
           'tgl_keluhan_pertama' => $row[11],
           'tgl_diagnosis' => $row[12],
           'tgl_pertama_terapi' => $row[13],
           'status_validasi' => $row[14],
           'nama_unit' => $row[15],
        ]);
    }
}
