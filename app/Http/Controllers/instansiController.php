<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class instansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Instansi::query();

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
        
            $query->where('instansi', 'like', "%$keyword%")
                    ->orWhere('post', 'like', "%$keyword%")
                    ->orWhere('alamat_instansi', 'like', "%$keyword%")
                    ->orWhere('no_telp', 'like', "%$keyword%")
                    ->orWhere('npwp', 'like', "%$keyword%");
        }
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
            'instansi' => 'required',
            'post' => 'required',
            'alamat_instansi' => 'required',
            'no_telp' => 'required',
            'npwp' => 'required',
        ]);
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data baru
        $data = Instansi::create($request->all());

        return response()->json([
            'message' => 'Data Instansi created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Instansi::where('id', $id)->get();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'instansi' => 'required',
            'post' => 'required',
            'alamat_instansi' => 'required',
            'no_telp' => 'required',
            'npwp' => 'required',
        ]);
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $instansi = Instansi::findOrFail($id);

        // Simpan data baru
        $instansi->update($request->all());

        return response()->json([
            'message' => 'Data Instansi updated successfully.',
            'data' => $instansi
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $data = Instansi::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data Instansi not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Data Instansi deleted successfully.'], 200);
    }
}
