<?php

namespace App\Http\Controllers;

use App\Imports\DiagnosisImport;
use App\Imports\ProfileImport;
use App\Imports\HistoriImport;
use App\Imports\RujukanImport;
use App\Imports\RekmedImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportsController extends Controller 
{
    // IMPORT FILE DIAGNOSIS
    // public function diagnosis(Request $request)
    // {
        
    //         // Manual validation using Lumen's Validator
    //         $validator = Validator::make($request->all(), [
    //             'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
    //         ]);

    //         // If validation fails, return a response with the errors
    //         if ($validator->fails()) {
    //             return response()->json(['error' => $validator->errors()->first()], 422);
    //         }

    //         // Check if the file is present in the request
    //         if ($request->hasFile('file')) {
    //             // Get the file from the request
    //             $file = $request->file('file');
                
    //             // Import the file directly
    //             Excel::import(new DiagnosisImport, $file);

    //             // Return a success message
    //             return response()->json(['message' => 'Imported Successfully!'], 200);
    //         }

    //         // If no file is uploaded, return an error message
    //         return response()->json(['error' => 'No file uploaded.'], 400);    
        
    // }
    public function diagnosis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        try {
            $file = $request->file('file');

            // Validasi isi file sebelum import
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $validRowCount = 0;

            foreach ($rows as $index => $row) {
                if ($index === 0) continue; // skip header

                // Validasi kolom 0 dan 1 wajib isi
                if (
                    isset($row[0]) && isset($row[1]) &&
                    trim($row[0]) !== '' && trim($row[1]) !== ''
                ) {
                    $validRowCount++;
                }
            }

            if ($validRowCount === 0) {
                return response()->json(['error' => 'File is empty or all rows incomplete.'], 422);
            }

            // Jalankan import TANPA manggil getRowCount
            Excel::import(new DiagnosisImport, $file);

            return response()->json([
                'message' => 'Import completed successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Import failed: ' . $e->getMessage()], 500);
        }
    }

    // IMPORT FILE PROFILE PASIEN
    public function profile(Request $request)
    {
        
            // Manual validation using Lumen's Validator
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
            ]);

            // If validation fails, return a response with the errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            // Check if the file is present in the request
            if ($request->hasFile('file')) {
                // Get the file from the request
                $file = $request->file('file');
                
                // Import the file directly
                Excel::import(new ProfileImport, $file);

                // Return a success message
                return response()->json(['message' => 'Imported Successfully!'], 200);
            }

            // If no file is uploaded, return an error message
            return response()->json(['error' => 'No file uploaded.'], 400);    
        
    }

    // IMPORT FILE HISTORI PASIEN
    public function histori(Request $request)
    {
        
            // Manual validation using Lumen's Validator
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
            ]);

            // If validation fails, return a response with the errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            // Check if the file is present in the request
            if ($request->hasFile('file')) {
                // Get the file from the request
                $file = $request->file('file');
                
                // Import the file directly
                Excel::import(new HistoriImport, $file);

                // Return a success message
                return response()->json(['message' => 'Imported Successfully!'], 200);
            }

            // If no file is uploaded, return an error message
            return response()->json(['error' => 'No file uploaded.'], 400);    
        
    }

    // IMPORT FILE RUJUKAN PASIEN
    public function rujukan(Request $request)
    {
        
            // Manual validation using Lumen's Validator
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
            ]);

            // If validation fails, return a response with the errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            // Check if the file is present in the request
            if ($request->hasFile('file')) {
                // Get the file from the request
                $file = $request->file('file');
                
                // Import the file directly
                Excel::import(new RujukanImport, $file);

                // Return a success message
                return response()->json(['message' => 'Imported Successfully!'], 200);
            }

            // If no file is uploaded, return an error message
            return response()->json(['error' => 'No file uploaded.'], 400);    
        
    }

    // IMPORT FILE REKAM MEDIS PASIEN
    public function rekmed(Request $request)
    {
        
            // Manual validation using Lumen's Validator
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
            ]);

            // If validation fails, return a response with the errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            // Check if the file is present in the request
            if ($request->hasFile('file')) {
                // Get the file from the request
                $file = $request->file('file');
                
                // Import the file directly
                Excel::import(new RekmedImport, $file);

                // Return a success message
                return response()->json(['message' => 'Imported Successfully!'], 200);
            }

            // If no file is uploaded, return an error message
            return response()->json(['error' => 'No file uploaded.'], 400);    
        
    }
}