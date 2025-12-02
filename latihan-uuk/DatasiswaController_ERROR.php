<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datasiswa;

class DatasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa=Datasiswa:all();
        return view('datasiswa' compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'requiered|string|max:255',
            'kelas_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        datasiswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $siswa_id)
    {
        $siswa = datasiswa::findOrFail($siswa_id);
        return view('show' compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $siswa_id)
    {
        $siswa = datasiswa::findOrFail($siswa_id)
        return view('edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $siswa_id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        datasiswa::where('siswa_id', $siswa_id)->update($request->except(['_token' '_method']));
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $siswa_id)
    {
        $siswa = datasiswa::findOrFail($siswa_id);
        $siswa->delete()
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
