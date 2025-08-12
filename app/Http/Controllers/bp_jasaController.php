<?php

namespace App\Http\Controllers;

use App\Models\Bp_jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bp_jasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bp_jasa::query();

        // 1. Logika Search by Keyword
        // Memeriksa apakah ada parameter 'keyword' di request.
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
        
            // Menambahkan klausa 'where' untuk mencari data yang cocok
            // pada kolom tertentu (misalnya 'judul' atau 'deskripsi').
            // Anda bisa tambahkan kolom lain sesuai kebutuhan.
            $query->where('post', 'like', "%$keyword%")
                    ->orWhere('nama_pekerjaan', 'like', "%$keyword%")
                    ->orWhere('instansi', 'like', "%$keyword%");
        }

        // Eksekusi query untuk mendapatkan data yang sudah difilter
        $data = $query->get();

        // Mengembalikan data sebagai JSON
        return response()->json($data, 200);

    }

    public function detail($id)
    {
        $data = Bp_jasa::where('id', $id)->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'post' => 'nullable|string',
            'tanggal' => 'required',
            'instansi' => 'required',
            'tahun_anggaran' => 'required',
            'nama_pekerjaan' => 'required',
            'nilai_pekerjaan' => 'required',
            'sub_kegiatan' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $instansi = $request->instansi;
        $tanggal = $request->tanggal;
        $post = $request->post;
        $pekerjaan = $request->nama_pekerjaan;
        if(is_null($post)) {
            $post = "$instansi/$pekerjaan/$tanggal";
        } 

        // Simpan buku baru
        $data = Bp_jasa::create([
            'post' => $post,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'tahun_anggaran' => $request->tahun_anggaran,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'nilai_pekerjaan' => $request->nilai_pekerjaan,
            'sub_kegiatan' => $request->sub_kegiatan,
        ]);

        return response()->json([
            'message' => 'Buku Proyek Jasa created successfully.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bp_jasa $bp_jasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'post' => 'nullable|string',
            'tanggal' => 'required',
            'instansi' => 'required',
            'tahun_anggaran' => 'required',
            'nama_pekerjaan' => 'required',
            'nilai_pekerjaan' => 'required',
            'sub_kegiatan' => 'required',
        ]);

        
        
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $instansi = $request->instansi;
        $tanggal = $request->tanggal;
        $pekerjaan = $request->nama_pekerjaan;
        $post = $request->post;
        if(is_null($post)) {
            $post = "$instansi/$pekerjaan/$tanggal";
        } 

        $bpj = Bp_jasa::findOrFail($id);

        // Simpan buku baru
        $bpj->update([
            'post' => $post,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'tahun_anggaran' => $request->tahun_anggaran,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'nilai_pekerjaan' => $request->nilai_pekerjaan,
            'sub_kegiatan' => $request->sub_kegiatan,
        ]);

        return response()->json([
            'message' => 'Buku Proyek Jasa Updated successfully.',
            'data' => $bpj
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $data = Bp_jasa::find($id);

        if (!$data) {
            return response()->json(['message' => 'Buku Proyek Jasa not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Buku Proyek Jasa deleted successfully.'], 200);
    }
}
