<?php

namespace App\Http\Controllers;

use App\Models\BarangDpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class barangDpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = BarangDpa::where('id_bpbarang', $id)->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'id_bpbarang' => 'required',
            'nama_barang' => 'required',
            'spesifikasi' => 'required',
            'vol' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'harga_total' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan buku baru
        $data = BarangDpa::create($request->all());

        return response()->json([
            'message' => 'Barang DPA created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangDpa $barangDpa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangDpa $barangDpa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = BarangDpa::find($id);

        if (!$data) {
            return response()->json(['message' => 'Barang DPA not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Barang DPA deleted successfully.'], 200);
    }
}
