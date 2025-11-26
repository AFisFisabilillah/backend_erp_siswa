<?php

namespace App\Http\Resources;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Siswa */
class SiswaResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            "nisn" => $this->nisn,
            "nik" => $this->nik,
            "nama_lengkap" => $this->nama_lengkap,
            "jenis_kelamin" => $this->jenis_kelamin,
            "tempat_lahir" => $this->tempat_lahir,
            "tanggal_lahir" => $this->tanggal_lahir,
            "jurusan" => $this->jurusan,
            "agama" => $this->agama,
            "nama_ayah" => $this->nama_ayah,
            "nama_ibu" => $this->nama_ibu,
            "alamat" => $this->alamat,
            "no_telp" => $this->no_telp,
            "foto" => $this->foto,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
