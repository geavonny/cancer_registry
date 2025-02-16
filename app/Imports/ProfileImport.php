<?php

namespace App\Imports;

use App\Models\ImportProfile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfileImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return ImportProfile|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportProfile::where('nama_lengkap', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new ImportProfile([
           'nama_lengkap'   => $row[0],
           'no_registrasi'    => $row[1], 
           'no_rekam_medis' => $row[2],
           'nik' => $row[3],
           'tempat_lahir' => $row[4],
           'tanggal_lahir' => $row[5],
           'jenis_kelamin' => $row[6],
           'usia_terdiagnosis' => $row[7],
           'alamat' => $row[8],
           'propinsi' => $row[9],
           'kabupaten' => $row[10],
           'kecamatan' => $row[11],
           'desa' => $row[12],
           'no_hp' => $row[13],
           'no_hp2' => $row[14],
           'no_bpjs' => $row[15],
           'bb' => $row[16],
           'tb' => $row[17],
           'kesimpulan' => $row[18],
        ]);
    }
}
