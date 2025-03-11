<?php

namespace App\Imports;

use App\Models\ImportRekmed;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekmedImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return ImportRekmed|null
     */
    public function model(array $row)
    {
        // dd($row);
        
        // Check if a record with the same 'nik' already exists
        // $existingRecord = ImportRekmed::where('no_registrasi', $row['no_registrasi'])->first();

        // // If the record already exists, return null to skip it
        // if ($existingRecord) {
        //     return null;
        // }
        
        // Convert the Excel date (numeric) to a MySQL-compatible date format
        // $tglkunjungan = Date::excelToDateTimeObject($row['tgl_kunjungan']);
        // $formattglkunjungan = $tglkunjungan->format('Y-m-d');
        
        // $tglevaluasi = Date::excelToDateTimeObject($row['tgl_evaluasi']);
        // $formattglevaluasi = $tglevaluasi->format('Y-m-d');
        
        // $tglperiksa = Date::excelToDateTimeObject($row['tgl_periksa_lab']);
        // $formattglperiksa = $tglperiksa->format('Y-m-d');

        // If the record doesn't exist, create a new record
        return new ImportRekmed([
           'nama_lengkap'   => $row['nama_lengkap'],
           'no_registrasi'    => $row['no_registrasi'], 
           'no_rekam_medis' => $row['no_rekam_medis'],
           'tgl_kunjungan' => $row['tgl_kunjungan'],
           'keluhan_utama' => $row['keluhan_utama'],
           'siklus_ke' => $row['siklus_ke'],
           'komplikasi_penyakit_dasar' => $row['komplikasi_penyakit_dasar'],
           'komplikasi_kemoterapi' => $row['komplikasi_kemoterapi'],
           'infeksi_kemo' => $row['infeksi_kemo'],
           'non_infeksi_kemo' => $row['non_infeksi_kemo'],
           'evaluasi_pengobatan' => $row['evaluasi_pengobatan'],
           'tgl_evaluasi' => $row['tgl_evaluasi'],
           'evaluasi_pengobatan_lain' => $row['evaluasi_pengobatan_lain'],
           'keluhan_tujuan_lain' => $row['keluhan_tujuan_lain'],
           'pemeriksaan_fisik' => $row['pemeriksaan_fisik'],
           'ukuran_tumor' => $row['ukuran_tumor'],
           'lokasi_limfadenompati' => $row['lokasi_limfadenompati'],
           'besar_hepar' => $row['besar_hepar'],
           'besar_lien' => $row['besar_lien'],
           'schuffner' => $row['schuffner'],
           'pemeriksaan_fisik_lainnya' => $row['pemeriksaan_fisik_lainnya'],
           'tgl_periksa_lab' => $row['tgl_periksa_lab'],
           'hemoglobin' => $row['hemoglobin'],
           'leukosit' => $row['leukosit'],
           'trombosit' => $row['trombosit'],
           'blast' => $row['blast'],
           'tumor_marker' => $row['tumor_marker'],
           'limfoblas' => $row['limfoblas'],
           'tambahan_infeksi' => $row['tambahan_infeksi'],
           'tambahan_non_infeksi' => $row['tambahan_non_infeksi'],
           'plan' => $row['plan'],
           'plan_lainnya' => $row['plan_lainnya'],
        ]);
    }
}