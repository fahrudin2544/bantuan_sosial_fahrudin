<?php

namespace App\Http\Controllers;

use App\Models\PenerimaBantuan;
use App\Models\AssessmentPenerima;
use Illuminate\Http\Request;

class PenerimaBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = PenerimaBantuan::with('assessments');

        if ($request->has('kategori_kelayakan')) {
            $query->whereHas('assessments', function ($q) use ($request) {
                $q->where('kategori_kelayakan', $request->kategori_kelayakan);
            });
        }

        if ($request->has('pendapatan_min') && $request->has('pendapatan_max')) {
            $query->whereHas('assessments', function ($q) use ($request) {
                $q->whereBetween('pendapatan_bulanan', [$request->pendapatan_min, $request->pendapatan_max]);
            });
        }

        if ($request->has('jumlah_tanggungan')) {
            $query->whereHas('assessments', function ($q) use ($request) {
                $q->where('jumlah_tanggungan', '>=', $request->jumlah_tanggungan);
            });
        }

        if ($request->has('kondisi_rumah')) {
            $query->whereHas('assessments', function ($q) use ($request) {
                $q->where('kondisi_rumah', $request->kondisi_rumah);
            });
        }

        $penerima = $query->paginate(10);
        return view('penerima.index', compact('penerima'));
    }

    public function create()
    {
        return view('penerima.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penerima_bantuan',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status_bantuan' => 'required|in:Aktif,Tidak Aktif',
        ]);

        PenerimaBantuan::create($request->all());
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil ditambahkan.');
    }

    public function show(PenerimaBantuan $penerima)
    {
        $penerima->load('assessments');
        return view('penerima.show', compact('penerima'));
    }

    public function edit(PenerimaBantuan $penerima)
    {
        return view('penerima.edit', compact('penerima'));
    }

    public function update(Request $request, PenerimaBantuan $penerima)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penerima_bantuan,nik,' . $penerima->id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status_bantuan' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $penerima->update($request->all());
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy(PenerimaBantuan $penerima)
    {
        $penerima->delete();
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil dihapus.');
    }
}