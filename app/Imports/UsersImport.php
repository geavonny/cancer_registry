<?php

namespace App\Imports;

use App\Models\Imports;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Imports|null
     */
    public function model(array $row)
    {
        // Check if a record with the same 'nik' already exists
        $existingRecord = Imports::where('nama', $row[0])->first();

        // If the record already exists, return null to skip it
        if ($existingRecord) {
            return null;
        }

        // If the record doesn't exist, create a new record
        return new Imports([
           'nama'   => $row[0],
           'nik'    => $row[1], 
           'status' => $row[2],
        ]);
    }
}
