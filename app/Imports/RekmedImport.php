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
           'nama_lengkap'   => $row['nama_lengkap'] ?? null,
           'no_registrasi'    => $row['no_registrasi'] ?? null, 
           'no_rekam_medis' => $row['no_rekam_medis'] ?? null,
           'tgl_kunjungan' => $row['tgl_kunjungan'] ?? null,
           'keluhan_utama' => $row['keluhan_utama'] ?? null,
           'siklus_ke' => $row['siklus_ke'] ?? null,
           'komplikasi_penyakit_dasar' => $row['komplikasi_penyakit_dasar'] ?? null,
           'komplikasi_kemoterapi' => $row['komplikasi_kemoterapi'] ?? null,
           'infeksi_kemo' => $row['infeksi_kemo'] ?? null,
           'non_infeksi_kemo' => $row['non_infeksi_kemo'] ?? null,
           'evaluasi_pengobatan' => $row['evaluasi_pengobatan'] ?? null,
           'tgl_evaluasi' => $row['tgl_evaluasi'] ?? null,
           'evaluasi_pengobatan_lain' => $row['evaluasi_pengobatan_lain'] ?? null,
           'keluhan_tujuan_lain' => $row['keluhan_tujuan_lain'] ?? null,
           'pemeriksaan_fisik' => $row['pemeriksaan_fisik'] ?? null,
           'ukuran_tumor' => $row['ukuran_tumor'] ?? null,
           'lokasi_limfadenompati' => $row['lokasi_limfadenompati'] ?? null,
           'besar_hepar' => $row['besar_hepar'] ?? null,
           'besar_lien' => $row['besar_lien'] ?? null,
           'schuffner' => $row['schuffner'] ?? null,
           'pemeriksaan_fisik_lainnya' => $row['pemeriksaan_fisik_lainnya'] ?? null,
           'tgl_periksa_lab' => $row['tgl_periksa_lab'] ?? null,
           'hemoglobin' => $row['hemoglobin'] ?? null,
           'leukosit' => $row['leukosit'] ?? null,
           'trombosit' => $row['trombosit'] ?? null,
           'blast' => $row['blast'] ?? null,
           'tumor_marker' => $row['tumor_marker'] ?? null,
           'limfoblas' => $row['limfoblas'] ?? null,
           'tambahan_infeksi' => $row['tambahan_infeksi'] ?? null,
           'tambahan_non_infeksi' => $row['tambahan_non_infeksi'] ?? null,
           'plan' => $row['plan'] ?? null,
           'plan_lainnya' => $row['plan_lainnya'] ?? null,
        ]);
    }
}