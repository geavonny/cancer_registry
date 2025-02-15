<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ImportsController extends Controller 
{
    public function import(Request $request)
    {
        // Manual validation using Lumen's Validator
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv', // Only allow Excel or CSV files
        ]);

        // If validation fails, return a response with the errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Check if the file is present in the request
        if ($request->hasFile('file')) {
            // Get the file from the request
            $file = $request->file('file');
            
            // Import the file directly
            Excel::import(new UsersImport, $file);

            // Return a success message
            return response()->json(['message' => 'Imported Successfully!'], 200);
        }

        // If no file is uploaded, return an error message
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
