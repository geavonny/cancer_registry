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
         // Jika row kosong, abaikan
        if (empty($row)) {
            return null;
        }

        // Pastikan kolom yang diperlukan tersedia
        if (!isset($row['nama_lengkap'])) {
            return null; // Abaikan jika tidak lengkap
        }
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
           'nama_lengkap'           => $row['nama_lengkap'] ?? null,
           'no_registrasi'          => $row['no_registrasi'] ?? null, 
           'no_rekam_medis'         => $row['no_rekam_medis'] ?? null,
           'kode_subgroup'          => $row['kode_subgroup'] ?? null,
           'subgroup'               => $row['subgroup'] ?? null,
           'kode_morfologi'         => $row['kode_morfologi'] ?? null,
           'morfologi'              => $row['morfologi'] ?? null,
           'kode_topografi'         => $row['kode_topografi'] ?? null,
           'topografi'              => $row['topografi'] ?? null,
           'literalitas'            => $row['literalitas'] ?? null,
           'tgl_pertama_konsultasi' => $row['tgl_pertama_konsultasi'] ?? null,
        ]);
    }
}