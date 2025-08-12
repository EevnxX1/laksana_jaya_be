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
    public function index(Request $request)
    {
        // Memulai query builder. Menggunakan Bkk::query() adalah cara terbaik
        // untuk membangun query secara dinamis.
        $query = Bkb::query();

        // 1. Logika Search by Keyword
        // Memeriksa apakah ada parameter 'keyword' di request.
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
        
            // Menambahkan klausa 'where' untuk mencari data yang cocok
            // pada kolom tertentu (misalnya 'judul' atau 'deskripsi').
            // Anda bisa tambahkan kolom lain sesuai kebutuhan.
            $query->where('kd_transaksi', 'like', "%$keyword%")
                    ->orWhere('uraian', 'like', "%$keyword%");
        }

        // 2. Logika Search by Date Range
        // Memeriksa apakah ada parameter 'start_date' dan 'end_date'.
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
        
            // Menambahkan klausa 'whereBetween' untuk mencari data dalam rentang tanggal
            // pada kolom 'created_at'. Anda bisa ganti 'created_at' jika perlu.
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        // Eksekusi query untuk mendapatkan data yang sudah difilter
        $data = $query->get();

        // Mengembalikan data sebagai JSON
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
