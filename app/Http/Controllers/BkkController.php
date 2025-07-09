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
        $bkk = Bkk::all(); // Ambil semua buku beserta relasi user
        return response()->json($bkk, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uang_masuk(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'uraian' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $saldo = \App\Models\Bkk::latest()->value('saldo');
        $total = null;
        if(is_null($saldo)) {
            $total = $request->kredit;
        } else {
            $total = $saldo + $request->kredit;
        }

        // Simpan buku baru
        $bkk = Bkk::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'saldo' => $total,
        ]);

        return response()->json([
            'message' => 'Buku Kas Kecil created successfully.',
            'book' => $bkk
        ], 201);
    }

    public function uang_keluar(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'uraian' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $saldo = \App\Models\Bkk::latest()->value('saldo');
        $total = null;
        if(is_null($saldo)) {
            return response()->json([
                'message' => 'data awal tidak bisa menginput debit!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $total = $saldo - $request->debit;
        }

        // Simpan buku baru
        $bkk = Bkk::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'saldo' => $total,
        ]);

        return response()->json([
            'message' => 'Buku Kas Kecil created successfully.',
            'book' => $bkk
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
    public function destroy(Bkk $bkk)
    {
        //
    }
}
