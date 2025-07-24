<?php

namespace App\Http\Controllers;

use App\Models\Bp_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bp_barangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bpb = Bp_barang::all(); // Ambil semua buku beserta relasi user
        return response()->json($bpb, 200);
    }
    public function detail($id)
    {
        $data = Bp_barang::where('id', $id)->get();
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
            'post' => 'nullable|string',
            'nomor_sp' => 'required',
            'tgl_sp' => 'required',
            'instansi' => 'required',
            'pekerjaan' => 'required',
            'sub_kegiatan' => 'required',
            'tahun_anggaran' => 'required',
            'mulai_pekerjaan' => 'required',
            'selesai_pekerjaan' => 'required',
            'label_pekerjaan' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $instansi = $request->instansi;
        $tanggal = $request->tanggal;
        $label = $request->label_pekerjaan;
        $post = $request->post;
        if(is_null($post)) {
            $post = "$instansi/$label/$tanggal";
        } 

        // Simpan buku baru
        $bpb = Bp_barang::create([
            'tanggal' => $request->tanggal,
            'post' => $post,
            'nomor_sp' => $request->nomor_sp,
            'tgl_sp' => $request->tgl_sp,
            'instansi' => $request->instansi,
            'pekerjaan' => $request->pekerjaan,
            'sub_kegiatan' => $request->sub_kegiatan,
            'tahun_anggaran' => $request->tahun_anggaran,
            'mulai_pekerjaan' => $request->mulai_pekerjaan,
            'selesai_pekerjaan' => $request->selesai_pekerjaan,
            'label_pekerjaan' => $request->label_pekerjaan,
        ]);

        return response()->json([
            'message' => 'Buku Kas Kecil created successfully.',
            'bpb' => $bpb
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bp_barang $bp_barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bp_barang $bp_barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bp_barang $bp_barang)
    {
        //
    }
}
