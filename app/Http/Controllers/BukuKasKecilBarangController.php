<?php

namespace App\Http\Controllers;

use App\Models\BkkBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuKasKecilBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = BkkBarang::where('id_bpbarang', $id)->get();
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
            'tanggal' => 'required',
            'instansi' => 'required',
            'pekerjaan' => 'required',
            'nama_barang' => 'required',
            'harga_satuan' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'nota' => 'required',
            'harga_total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Upload gambar jika ada
        if ($request->hasFile('nota')) {
        $file = $request->file('nota');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('data_nota', $filename, 'public');
        $url = asset('storage/' . $path);

        } else {
            return response()->json(['error' => 'Tidak ada file yang diupload'], 400);
        }

        // Simpan buku baru
        $data = BkkBarang::create([
            'id_bpbarang' => $request->id_bpbarang,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'pekerjaan' => $request->pekerjaan,
            'nama_barang' => $request->nama_barang,
            'harga_satuan' => $request->harga_satuan,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
            'nota' => isset($url) ? $url : null,  // Menyimpan URL gambar,
            'harga_total' => $request->harga_total,
        ]);

        return response()->json([
            'message' => 'Bkk Barang created successfully.',
            'book' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BkkBarang $bkkBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BkkBarang $bkkBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BkkBarang $bkkBarang)
    {
        //
    }
}
