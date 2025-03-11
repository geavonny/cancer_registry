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
           'nama_lengkap'   => $row['nama_lengkap'],
           'no_registrasi'    => $row['no_registrasi'], 
           'no_rekam_medis' => $row['no_rekam_medis'],
           'dasar_diagnosis' => $row['dasar_diagnosis'],
           'bb_lahir' => $row['bb_lahir'],
           'imunisasi' => $row['imunisasi'],
           'asi_eksklusif' => $row['asi_eksklusif'],
           'riwayat_keganasan_keluarga' => $row['riwayat_keganasan_keluarga'],
           'ket_keganasan_keluarga' => $row['ket_keganasan_keluarga'],
           'tata_laksana' => $row['tata_laksana'],
           'staging_stadium' => $row['staging_stadium'],
           'tgl_keluhan_pertama' => $row['tgl_keluhan_pertama'],
           'tgl_diagnosis' => $row['tgl_diagnosis'],
           'tgl_pertama_terapi' => $row['tgl_pertama_terapi'],
           'status_validasi' => $row['status_validasi'],
           'nama_unit' => $row['nama_unit'],
        ]);
    }
}
