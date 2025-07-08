<?php

namespace App\Http\Controllers;

use App\Models\Bkk;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
