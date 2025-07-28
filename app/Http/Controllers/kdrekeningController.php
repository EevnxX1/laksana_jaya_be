<?php

namespace App\Http\Controllers;

use App\Models\KdRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class kdrekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = KdRekening::where('id_bpbarang', $id)->get();
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
            'no_rekening' => 'required',
            'ket' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan buku baru
        $data = KdRekening::create($request->all());

        return response()->json([
            'message' => 'Kode Rekening created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(KdRekening $kdRekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KdRekening $kdRekening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = KdRekening::find($id);

        if (!$data) {
            return response()->json(['message' => 'Kode Rekening not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Kode Rekening deleted successfully.'], 200);
    }
}
