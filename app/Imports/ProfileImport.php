<?php

namespace App\Imports;

use App\Models\ImportProfile;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProfileImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return ImportProfile|null
     */
    public function model(array $row)
    {
        // dd($row);
        
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportProfile::where('no_registrasi', $row['no_registrasi'])
                                        ->Where('nik', $row['nik'])
                                        ->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }
        
        // Convert the Excel date (numeric) to a MySQL-compatible date format
        // $tgllahir = Date::excelToDateTimeObject($row['tanggal_lahir']);
        // $formattgllahir = $tgllahir->format('Y-m-d');

        // If the record doesn't exist, create a new record
        return new ImportProfile([
           'nama_lengkap'   => $row['nama_lengkap'],
           'no_registrasi'    => $row['no_registrasi'], 
           'no_rekam_medis' => $row['no_rekam_medis'],
           'nik' => $row['nik'],
           'tempat_lahir' => $row['tempat_lahir'],
           'tanggal_lahir' => $row['tanggal_lahir'],
           'jenis_kelamin' => $row['jenis_kelamin'],
           'usia_terdiagnosis' => $row['usia_terdiagnosis'],
           'alamat' => $row['alamat'],
           'propinsi' => $row['propinsi'],
           'kabupaten' => $row['kabupaten'],
           'kecamatan' => $row['kecamatan'],
           'desa' => $row['desa'],
           'no_hp' => $row['no_hp'],
           'no_hp2' => $row['no_hp2'],
           'no_bpjs' => $row['no_bpjs'],
           'bb' => $row['bb'],
           'tb' => $row['tb'],
           'kesimpulan' => $row['kesimpulan'],
        ]);
    }
}