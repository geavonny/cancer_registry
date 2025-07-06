<?php

namespace App\Imports;

use App\Models\ImportRujukan;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RujukanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return ImportRujukan|null
     */
    public function model(array $row)
    {
        // dd($row);
        
        // Check if a record with the same 'nik' already exists
        // $existingRecord = ImportRujukan::where('nama_lengkap', $row['nama_lengkap'])->first();

        // // If the record already exists, return null to skip it
        // if ($existingRecord) {
        //     return null;
        // }
        
        // Convert the Excel date (numeric) to a MySQL-compatible date format
        // $tglppk = Date::excelToDateTimeObject($row['tgl_ppk']);
        // $formattglppk = $tglppk->format('Y-m-d');

        // If the record doesn't exist, create a new record
        return new ImportRujukan([
           'nama_lengkap'   => $row['nama_lengkap'] ?? null,
           'no_registrasi'    => $row['no_registrasi'] ?? null, 
           'no_rekam_medis' => $row['no_rekam_medis'] ?? null,
           'ppk' => $row['ppk'] ?? null,
           'tgl_ppk' => $row['tgl_ppk'] ?? null,
        ]);
    }
}