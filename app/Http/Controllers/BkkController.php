<?php

namespace App\Http\Controllers;

use App\Models\Bkk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BkkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bkk::all(); // Ambil semua buku beserta relasi user
        return response()->json($data, 200);
    }
    public function detail_barang($id)
    {
        $data = Bkk::where('id_bpbarang', $id)
                 ->where('identity_uk', 'buku_barang')
                 ->get();

        return response()->json($data, 200);

    }
    public function detail_kantor()
    {
        $data = Bkk::where('identity_uk', 'buku_kantor')->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bpbarang' => 'required',
            'id_bpjasa' => 'required',
            'identity' => 'required',
            'identity_uk' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'pekerjaan' => 'required',
            'uraian' => 'required',
            'harga_satuan' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'nota' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan buku baru
        $data = Bkk::create($request->all());

        return response()->json([
            'message' => 'Bkk uang masuk created successfully.',
            'data' => $data
        ], 201);
    }

    public function uang_keluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bpbarang' => 'required',
            'id_bpjasa' => 'required',
            'identity' => 'required',
            'identity_uk' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'pekerjaan' => 'required',
            'uraian' => 'required',
            'harga_satuan' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'nota' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
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
        $data = Bkk::create([
            'id_bpbarang' => $request->id_bpbarang,
            'id_bpjasa' => $request->id_bpjasa,
            'identity' => $request->identity,
            'identity_uk' => $request->identity_uk,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'pekerjaan' => $request->pekerjaan,
            'uraian' => $request->uraian,
            'harga_satuan' => $request->harga_satuan,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
            'nota' => isset($url) ? $url : null,  // Menyimpan URL gambar,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
        ]);

        return response()->json([
            'message' => 'Bkk uang masuk created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bkk $bkk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bkk $bkk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Bkk::find($id);

        if (!$data) {
            return response()->json(['message' => 'Buku Kas Kecik not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Buku Kas Kecik deleted successfully.'], 200);
    }
}
