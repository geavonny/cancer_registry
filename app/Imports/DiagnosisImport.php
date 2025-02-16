<?php

namespace App\Imports;

use App\Models\ImportDiagnosis;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DiagnosisImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return ImportDiagnosis|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportDiagnosis::where('nama_lengkap', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new ImportDiagnosis([
           'nama_lengkap'   => $row[0],
           'no_registrasi'    => $row[1], 
           'no_rekam_medis' => $row[2],
           'kode_subgroup' => $row[3],
           'subgroup' => $row[4],
           'kode_morfologi' => $row[5],
           'morfologi' => $row[6],
           'kode_topografi' => $row[7],
           'topografi' => $row[8],
           'literalitas' => $row[9],
           'tgl_pertama_konsultasi' => $row[10],
        ]);
    }
}
