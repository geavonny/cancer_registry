<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    //fungsi untuk menampilkan data FAQ
    public function index() 
    {
        $faq = Faq::all();    
        return response()->json([
            'success' => true,
            'message' =>'List Semua FAQ',
            'data'    => $faq
        ], 200);
    }    

    //fungsi untuk menambahkan data FAQ
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua kolom required wajib diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $faq = Faq::create([
                'pertanyaan' => $request->input('pertanyaan'),
                'jawaban'   => $request->input('jawaban'),
            ]);

            if ($faq) {
                return response()->json([
                    'success' => true,
                    'message' => 'FAQ berhasil disimpan!',
                    'data' => $faq
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'FAQ gagal disimpan!',
                ], 400);
            }
        }
    }
    
    //fungsi untuk mencari data FAQ berdasarkan id FAQ
    public function show($id = null) 
    {
        $faq = Faq::where('id',$id)
                            ->get();
        // $faq = $no_registrasi;
       
        if($faq->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' =>'Data FAQ',
                'data'    => $faq
            ], 200);
        }        
    }

    //fungsi untuk update data FAQ berdasarkan id FAQ
    public function update(Request $request, $id) 
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'nullable',
            'jawaban' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data'   => $validator->errors()
            ], 401);
        }

        // Ambil data lama dari database
        $existingFaq = Faq::find($id);

        if (!$existingFaq) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan!'
            ], 404);
        }

        // Gabungkan data lama dengan data baru
        $updatedData = array_merge(
            $existingFaq->toArray(),
            $request->only(array_keys($validator->getRules()))
        );

        // Update data ke database
        $faq = $existingFaq->update($updatedData);

        if ($faq) {
            return response()->json([
                'success' => true,
                'message' => 'Data FAQ berhasil diperbarui!',
                'data' => $updatedData
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data FAQ gagal diperbarui!'
            ], 400);
        }
    }

    //fungsi untuk menghapus data FAQ berdasarkan id FAQ
    public function destroy($id) 
    {
        $faq = Faq::where('id',$id)->first();
            $faq->delete();   

        if ($faq) {
            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil dihapus!',
            ], 200);
        }
    }
}