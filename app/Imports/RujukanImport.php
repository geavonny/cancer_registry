<?php

namespace App\Imports;

use App\Models\ImportRujukan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class RujukanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return ImportRujukan|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportRujukan::where('nama_lengkap', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new ImportRujukan([
           'nama_lengkap'   => $row[0],
           'no_registrasi'    => $row[1], 
           'no_rekam_medis' => $row[2],
           'ppk' => $row[3],
           'tgl_ppk' => $row[4],
        ]);
    }
}
