<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = pasien::all();
        return view('data_pasien', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('tambah_pasien');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pasien' => 'required|integer|unique:pasiens,no_pasien',
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string',
        ]);

        pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pasien $pasien)
    {
        $pasien = pasien::findOrFail($pasien);
        return view('detail_pasien', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pasien $pasien)
    {
        $pasien = pasien::findOrFail($pasien);
        return view('edit_pasien', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pasien $pasien)
    {
        $request->validate([
            'no_pasien' => 'required|integer|unique:pasiens,no_pasien,'.$pasien->id,
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string',
        ]);

    $pasien = pasien::where('id', '$id')->update($request->except(['_token', '_method']));
    return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pasien $pasien)
    {
        $pasien = pasien::findOrFail($pasien);
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
