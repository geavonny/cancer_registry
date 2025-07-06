<?php

namespace App\Imports;

use App\Models\ImportHistori;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HistoriImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return ImportHistori|null
     */
    public function model(array $row)
    {
        // dd($row);
         // Jika row kosong, abaikan
        if (empty($row)) {
            return null;
        }

        // Pastikan kolom yang diperlukan tersedia
        if (!isset($row['no_registrasi'])) {
            return null; // Abaikan jika tidak lengkap
        }
        // Check if a record with the same 'nik' already exists
        $existingRecord = ImportHistori::where('no_registrasi', $row['no_registrasi'])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }
        
        // Convert the Excel date (numeric) to a MySQL-compatible date format
        // $tglkeluhan = Date::excelToDateTimeObject($row['tgl_keluhan_pertama']);
        // $formattglkeluhan = $tglkeluhan->format('Y-m-d');
        
        // $tgldiagnosis = Date::excelToDateTimeObject($row['tgl_diagnosis']);
        // $formattgldiagnosis = $tgldiagnosis->format('Y-m-d');
        
        // $tglterapi = Date::excelToDateTimeObject($row['tgl_pertama_terapi']);
        // $formattglterapi = $tglterapi->format('Y-m-d');

        // If the record doesn't exist, create a new record
        return new ImportHistori([
           'nama_lengkap'               => $row['nama_lengkap'] ?? null,
           'no_registrasi'              => $row['no_registrasi'] ?? null, 
           'no_rekam_medis'             => $row['no_rekam_medis'] ?? null,
           'dasar_diagnosis'            => $row['dasar_diagnosis'] ?? null,
           'bb_lahir'                   => $row['bb_lahir'] ?? null,
           'imunisasi'                  => $row['imunisasi'] ?? null,
           'asi_eksklusif'              => $row['asi_eksklusif'] ?? null,
           'riwayat_keganasan_keluarga' => $row['riwayat_keganasan_keluarga'] ?? null,
           'ket_keganasan_keluarga'     => $row['ket_keganasan_keluarga'] ?? null,
           'tata_laksana'               => $row['tata_laksana'] ?? null,
           'staging_stadium'            => $row['staging_stadium'] ?? null,
           'tgl_keluhan_pertama'        => $row['tgl_keluhan_pertama'] ?? null,
           'tgl_diagnosis'              => $row['tgl_diagnosis'] ?? null,
           'tgl_pertama_terapi'         => $row['tgl_pertama_terapi'] ?? null,
           'status_validasi'            => $row['status_validasi'] ?? null,
           'nama_unit'                  => $row['nama_unit'] ?? null,
        ]);
    }
}
