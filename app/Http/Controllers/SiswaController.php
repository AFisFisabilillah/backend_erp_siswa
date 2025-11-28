<?php

namespace App\Http\Controllers;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use App\Http\Requests\SiswaRequest;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereFullText('nama_lengkap', $search)
                ->orWhere('nisn', 'like', "%{$search}%");
        }

        if ($request->filled('tanggal_lahir')) {
            $query->whereDate('tanggal_lahir', $request->tanggal_lahir);
        }

        $siswas = $query->latest()->paginate(10);


        return SiswaResource::collection($siswas);
    }


    public function store(SiswaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('siswa_fotos', 'public');
            $data['foto'] = $path;
        }else{
            $data['foto'] = "no_profile.jpeg";
        }

        $siswa = Siswa::create($data);

        return new SiswaResource($siswa);

    }


    public function show(int $siswaId)
    {
        $siswa = Siswa::find($siswaId);
        if (!$siswa){
            return response()->json([
                "messages"=>"Siswa tidak ditemukan"
            ], 404);
        }
        return new SiswaResource($siswa);
    }

    public function update(SiswaRequest $request, int $siswaId)
    {
        $data = $request->validated();

        $siswa = Siswa::find($siswaId);
        if (!$siswa){
            return response()->json([
                "messages"=>"Siswa tidak ditemukan"
            ], 404);
        }

        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            $path = $request->file('foto')->store('siswa_fotos', 'public');
            $data['foto'] = $path;
        }

        $siswa->update($data);

        return new SiswaResource($siswa);

    }


    public function destroy(int $siswaId)
    {
        $siswa = Siswa::find($siswaId);
        if (!$siswa){
            return response()->json([
                "messages"=>"Siswa tidak ditemukan"
            ], 404);
        }

        // Hapus file foto dari storage saat data dihapus
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return response()->json([
            'message' => 'Data siswa berhasil dihapus'
        ]);
    }


    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            // Proses import menggunakan class SiswaImport
            Excel::import(new SiswaImport, $request->file('file'));

            return response()->json([
                'message' => 'Data siswa berhasil diimport!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal import data: ' . $e->getMessage()
            ], 500);
        }
    }
}
