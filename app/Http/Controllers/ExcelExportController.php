<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Rujukan;
use App\Models\Profile;
use App\Models\Histori;
use App\Models\Diagnosis;
use App\Models\Rekam;

class ExcelExportController extends Controller
{
    // Fungsi untuk menampilkan halaman dengan tombol ekspor (opsional)
    public function index()
    {
        print('Hello world'); // Menampilkan halaman dengan tombol
    }

    // Fungsi untuk mengekspor data ke Excel
    public function exprujukan()
    {
        // dd('Hello world');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Export Rujukan');
        
        // Set header kolom
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'No Rekam Medis');
        $sheet->setCellValue('E1', 'PPK');
        $sheet->setCellValue('F1', 'Tgl PPK');

        // Isi data 
        $row = 2;

        $data = Rujukan::all();
        foreach ($data as $value){
            $sheet->setCellValue('A' . $row, $value->id);
            $sheet->setCellValue('B' . $row, $value->nama_lengkap);
            $sheet->setCellValue('C' . $row, $value->no_registrasi);
            $sheet->setCellValue('D' . $row, $value->no_rekam_medis);
            $sheet->setCellValue('E' . $row, $value->ppk);
            $sheet->setCellValue('F' . $row, $value->tgl_ppk);
            $row++;
        } 

        // Simpan dan download file Excel
        $fileName = "Data Export Rujukan.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }

    public function expprofile()
    {
        // dd('Hello world');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Export Profile Pasien');
        
        // Set header kolom
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'No Rekam Medis');
        $sheet->setCellValue('E1', 'NIK');
        $sheet->setCellValue('F1', 'Tempat Lahir');
        $sheet->setCellValue('G1', 'Tgl Lahir');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Usia Terdiagnosis');
        $sheet->setCellValue('J1', 'Alamat');
        $sheet->setCellValue('K1', 'Propinsi');
        $sheet->setCellValue('L1', 'Kabupaten');
        $sheet->setCellValue('M1', 'Kecamatan');
        $sheet->setCellValue('N1', 'Desa');
        $sheet->setCellValue('O1', 'No HP');
        $sheet->setCellValue('P1', 'No HP 2');
        $sheet->setCellValue('Q1', 'No BPJS');
        $sheet->setCellValue('R1', 'BB');
        $sheet->setCellValue('S1', 'TB');
        $sheet->setCellValue('T1', 'Kesimpulan');

        // Isi data 
        $row = 2;

        $data = Profile::all();
        foreach ($data as $value){
            $sheet->setCellValue('A' . $row, $value->id);
            $sheet->setCellValue('B' . $row, $value->nama_lengkap);
            $sheet->setCellValue('C' . $row, $value->no_registrasi);
            $sheet->setCellValue('D' . $row, $value->no_rekam_medis);
            $sheet->setCellValue('E' . $row, $value->nik);
            $sheet->setCellValue('F' . $row, $value->tempat_lahir);
            $sheet->setCellValue('G' . $row, $value->tanggal_lahir);
            $sheet->setCellValue('H' . $row, $value->jenis_kelamin);
            $sheet->setCellValue('I' . $row, $value->usia_terdiagnosis);
            $sheet->setCellValue('J' . $row, $value->alamat);
            $sheet->setCellValue('K' . $row, $value->propinsi);
            $sheet->setCellValue('L' . $row, $value->kabupaten);
            $sheet->setCellValue('M' . $row, $value->kecamatan);
            $sheet->setCellValue('N' . $row, $value->desa);
            $sheet->setCellValue('O' . $row, $value->no_hp);
            $sheet->setCellValue('P' . $row, $value->no_hp2);
            $sheet->setCellValue('Q' . $row, $value->no_bpjs);
            $sheet->setCellValue('R' . $row, $value->bb);
            $sheet->setCellValue('S' . $row, $value->tb);
            $sheet->setCellValue('T' . $row, $value->kesimpulan);
            $row++;
        } 

        // Simpan dan download file Excel
        $fileName = "Data Export Profile Pasien.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }

    public function expdiagnosis()
    {
        // dd('Hello world');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Export Diagnosis Pasien');
        
        // Set header kolom
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'No Rekam Medis');
        $sheet->setCellValue('E1', 'Kode Subgroup');
        $sheet->setCellValue('F1', 'Subgroup');
        $sheet->setCellValue('G1', 'Kode Morfologi');
        $sheet->setCellValue('H1', 'Morfologi');
        $sheet->setCellValue('I1', 'Kode Topografi');
        $sheet->setCellValue('J1', 'Topografi');
        $sheet->setCellValue('K1', 'Literalitas');
        $sheet->setCellValue('L1', 'Tgl Pertama Konsultasi');

        // Isi data 
        $row = 2;

        $data = Diagnosis::all();
        foreach ($data as $value){
            $sheet->setCellValue('A' . $row, $value->id);
            $sheet->setCellValue('B' . $row, $value->nama_lengkap);
            $sheet->setCellValue('C' . $row, $value->no_registrasi);
            $sheet->setCellValue('D' . $row, $value->no_rekam_medis);
            $sheet->setCellValue('E' . $row, $value->kode_subgroup);
            $sheet->setCellValue('F' . $row, $value->subgroup);
            $sheet->setCellValue('G' . $row, $value->kode_morfologi);
            $sheet->setCellValue('H' . $row, $value->morfologi);
            $sheet->setCellValue('I' . $row, $value->kode_topografi);
            $sheet->setCellValue('J' . $row, $value->topografi);
            $sheet->setCellValue('K' . $row, $value->literalitas);
            $sheet->setCellValue('L' . $row, $value->tgl_pertama_konsultasi);
            $row++;
        } 

        // Simpan dan download file Excel
        $fileName = "Data Export Diagnosis Pasien.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }

    public function exphistori()
    {
        // dd('Hello world');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Export Histori Pasien');
        
        // Set header kolom
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'No Rekam Medis');
        $sheet->setCellValue('E1', 'Dasar Diagnosis');
        $sheet->setCellValue('F1', 'BB Lahir');
        $sheet->setCellValue('G1', 'Imunisasi');
        $sheet->setCellValue('H1', 'ASI Eksklusif');
        $sheet->setCellValue('I1', 'Riwayat Keganasan Keluarga');
        $sheet->setCellValue('J1', 'Ket Keganasan Keluarga');
        $sheet->setCellValue('K1', 'Tata Laksana');
        $sheet->setCellValue('L1', 'Staging Stadium');
        $sheet->setCellValue('M1', 'Tgl Keluham Pertama');
        $sheet->setCellValue('N1', 'Tgl Diagnosis');
        $sheet->setCellValue('O1', 'Tgl Pertama Terapi');
        $sheet->setCellValue('P1', 'Status Validasi');
        $sheet->setCellValue('Q1', 'Nama Unit');

        // Isi data 
        $row = 2;

        $data = Histori::all();
        foreach ($data as $value){
            $sheet->setCellValue('A' . $row, $value->id);
            $sheet->setCellValue('B' . $row, $value->nama_lengkap);
            $sheet->setCellValue('C' . $row, $value->no_registrasi);
            $sheet->setCellValue('D' . $row, $value->no_rekam_medis);
            $sheet->setCellValue('E' . $row, $value->dasar_diagnosis);
            $sheet->setCellValue('F' . $row, $value->bb_lahir);
            $sheet->setCellValue('G' . $row, $value->imunisasi);
            $sheet->setCellValue('H' . $row, $value->asi_eksklusif);
            $sheet->setCellValue('I' . $row, $value->riwayat_keganasan_keluarga);
            $sheet->setCellValue('J' . $row, $value->ket_keganasan_keluarga);
            $sheet->setCellValue('K' . $row, $value->tata_laksana);
            $sheet->setCellValue('L' . $row, $value->staging_stadium);
            $sheet->setCellValue('M' . $row, $value->tgl_keluhan_pertama);
            $sheet->setCellValue('N' . $row, $value->tgl_diagnosis);
            $sheet->setCellValue('O' . $row, $value->tgl_pertama_terapi);
            $sheet->setCellValue('P' . $row, $value->status_validasi);
            $sheet->setCellValue('Q' . $row, $value->nama_unit);
            $row++;
        } 

        // Simpan dan download file Excel
        $fileName = "Data Export Histori Pasien.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }

    public function exprekam()
    {
        // dd('Hello world');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Export Rekam Medis Pasien');
        
        // Set header kolom
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'No Rekam Medis');
        $sheet->setCellValue('E1', 'Tgl Kunjungan');
        $sheet->setCellValue('F1', 'Keluhan Utama');
        $sheet->setCellValue('G1', 'Siklus Ke');
        $sheet->setCellValue('H1', 'Komplikasi Penyakit Dasar');
        $sheet->setCellValue('I1', 'Komplikasi Kemoterapi');
        $sheet->setCellValue('J1', 'Infeksi Kemo');
        $sheet->setCellValue('K1', 'Non Infeksi Kemo');
        $sheet->setCellValue('L1', 'Evaluasi Pengobatan');
        $sheet->setCellValue('M1', 'Tgl Evaluasi');
        $sheet->setCellValue('N1', 'Evaluasi Pengobatan Lain');
        $sheet->setCellValue('O1', 'Keluhan Tujuan Lain');
        $sheet->setCellValue('P1', 'Pemeriksaan Fisik');
        $sheet->setCellValue('Q1', 'Ukuran Tumor');
        $sheet->setCellValue('R1', 'Lokasi Limfadenompati');
        $sheet->setCellValue('S1', 'Besar Hepar');
        $sheet->setCellValue('T1', 'Besar Lien');
        $sheet->setCellValue('U1', 'Schnuffner');
        $sheet->setCellValue('V1', 'Pemeriksaan Fisik Lainnya');
        $sheet->setCellValue('W1', 'Tgl Periksa Lab');
        $sheet->setCellValue('X1', 'Hemoglobin');
        $sheet->setCellValue('Y1', 'Leukosit');
        $sheet->setCellValue('Z1', 'Trombosit');
        $sheet->setCellValue('AA1', 'Blast');
        $sheet->setCellValue('AB1', 'Tumor Marker');
        $sheet->setCellValue('AC1', 'Limfoblas');
        $sheet->setCellValue('AD1', 'Tambahan Infeksi');
        $sheet->setCellValue('AE1', 'Tambahan Non Infeksi');
        $sheet->setCellValue('AF1', 'Plan');
        $sheet->setCellValue('AG1', 'Plan lainnya');

        // Isi data 
        $row = 2;

        $data = Rekam::all();
        foreach ($data as $value){
            $sheet->setCellValue('A' . $row, $value->id);
            $sheet->setCellValue('B' . $row, $value->nama_lengkap);
            $sheet->setCellValue('C' . $row, $value->no_registrasi);
            $sheet->setCellValue('D' . $row, $value->no_rekam_medis);
            $sheet->setCellValue('E' . $row, $value->tgl_kunjungan);
            $sheet->setCellValue('F' . $row, $value->keluhan_utama);
            $sheet->setCellValue('G' . $row, $value->siklus_ke);
            $sheet->setCellValue('H' . $row, $value->komplikasi_penyakit_dasar);
            $sheet->setCellValue('I' . $row, $value->komplikasi_kemoterapi);
            $sheet->setCellValue('J' . $row, $value->infeksi_kemo);
            $sheet->setCellValue('K' . $row, $value->non_infeksi_kemo);
            $sheet->setCellValue('L' . $row, $value->evaluasi_pengobatan);
            $sheet->setCellValue('M' . $row, $value->tgl_evaluasi);
            $sheet->setCellValue('N' . $row, $value->evaluasi_pengobatan_lain);
            $sheet->setCellValue('O' . $row, $value->keluhan_tujuan_lain);
            $sheet->setCellValue('P' . $row, $value->pemeriksaan_fisik);
            $sheet->setCellValue('Q' . $row, $value->ukuran_tumor);
            $sheet->setCellValue('R' . $row, $value->lokasi_limfadenompati);
            $sheet->setCellValue('S' . $row, $value->besar_hepar);
            $sheet->setCellValue('T' . $row, $value->besar_lien);
            $sheet->setCellValue('U' . $row, $value->schuffner);
            $sheet->setCellValue('V' . $row, $value->pemeriksaan_fisik_lainnya);
            $sheet->setCellValue('W' . $row, $value->tgl_periksa_lab);
            $sheet->setCellValue('X' . $row, $value->hemoglobin);
            $sheet->setCellValue('Y' . $row, $value->leukosit);
            $sheet->setCellValue('Z' . $row, $value->trombosit);
            $sheet->setCellValue('AA' . $row, $value->blast);
            $sheet->setCellValue('AB' . $row, $value->tumor_marker);
            $sheet->setCellValue('AC' . $row, $value->limfoblas);
            $sheet->setCellValue('AD' . $row, $value->tambahan_infeksi);
            $sheet->setCellValue('AE' . $row, $value->tambahan_non_infeksi);
            $sheet->setCellValue('AF' . $row, $value->plan);
            $sheet->setCellValue('AG' . $row, $value->plan_lainnya);
            $row++;
        } 

        // Simpan dan download file Excel
        $fileName = "Data Export Rekam Medis Pasien.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }
}