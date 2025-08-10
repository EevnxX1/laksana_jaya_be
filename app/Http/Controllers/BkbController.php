<?php

namespace App\Http\Controllers;

use App\Models\Bkb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BkbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bkb::all(); // Ambil semua buku beserta relasi user
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'kd_transaksi' => 'required',
            'uraian' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data baru
        $data = Bkb::create($request->all());

        return response()->json([
            'message' => 'Buku Kas Besar created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Bkb::where('id', $id)->get();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'kd_transaksi' => 'required',
            'uraian' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $bkb = Bkb::findOrFail($id);

        // Simpan data baru
        $bkb->update($request->all());

        return response()->json([
            'message' => 'Buku Kas Besar updated successfully.',
            'data' => $bkb
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $data = Bkb::find($id);

        if (!$data) {
            return response()->json(['message' => 'Buku Kas Besar not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Buku Kas Besar deleted successfully.'], 200);
    }
}
