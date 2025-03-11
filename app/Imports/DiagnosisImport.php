<?php

namespace App\Imports;

use App\Models\ImportDiagnosis;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DiagnosisImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return ImportDiagnosis|null
     */
    public function model(array $row)
    {
        // dd($row);
        
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportDiagnosis::where('nama_lengkap', $row['nama_lengkap'])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // // Convert the Excel date (numeric) to a MySQL-compatible date format
        // $tglPertamaKonsultasi = Date::excelToDateTimeObject($row['tgl_pertama_konsultasi']);
        // $formattedDate = $tglPertamaKonsultasi->format('Y-m-d');

        // If the record doesn't exist, create a new record
        return new ImportDiagnosis([
           'nama_lengkap'   => $row['nama_lengkap'],
           'no_registrasi'    => $row['no_registrasi'], 
           'no_rekam_medis' => $row['no_rekam_medis'],
           'kode_subgroup' => $row['kode_subgroup'],
           'subgroup' => $row['subgroup'],
           'kode_morfologi' => $row['kode_morfologi'],
           'morfologi' => $row['morfologi'],
           'kode_topografi' => $row['kode_topografi'],
           'topografi' => $row['topografi'],
           'literalitas' => $row['literalitas'],
           'tgl_pertama_konsultasi' => $row['tgl_pertama_konsultasi'],
        ]);
    }
}