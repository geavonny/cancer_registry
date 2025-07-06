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
        // Jika row kosong, abaikan
        if (empty($row)) {
            return null;
        }

        // Pastikan kolom yang diperlukan tersedia
        if (!isset($row['no_registrasi']) || !isset($row['nik'])) {
            return null; // Abaikan jika tidak lengkap
        }

        // Cek apakah data dengan NIK & No Registrasi yang sama sudah ada
        $existingRecord = ImportProfile::where('no_registrasi', $row['no_registrasi'])
                                       ->where('nik', $row['nik'])
                                       ->first();

        // Jika sudah ada, abaikan
        if ($existingRecord) {
            return null;
        }

        // Insert data baru
        return new ImportProfile([
            'nama_lengkap'       => $row['nama_lengkap'] ?? null,
            'no_registrasi'      => $row['no_registrasi'] ?? null,
            'no_rekam_medis'     => $row['no_rekam_medis'] ?? null,
            'nik'                => $row['nik'] ?? null,
            'tempat_lahir'       => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'      => $row['tanggal_lahir'] ?? null,
            'jenis_kelamin'      => $row['jenis_kelamin'] ?? null,
            'usia_terdiagnosis'  => $row['usia_terdiagnosis'] ?? null,
            'alamat'             => $row['alamat'] ?? null,
            'propinsi'           => $row['propinsi'] ?? null,
            'kabupaten'          => $row['kabupaten'] ?? null,
            'kecamatan'          => $row['kecamatan'] ?? null,
            'desa'               => $row['desa'] ?? null,
            'no_hp'              => $row['no_hp'] ?? null,
            'no_hp2'             => $row['no_hp2'] ?? null,
            'no_bpjs'            => $row['no_bpjs'] ?? null,
            'bb'                 => $row['bb'] ?? null,
            'tb'                 => $row['tb'] ?? null,
            'kesimpulan'         => $row['kesimpulan'] ?? null,
        ]);
    }
}