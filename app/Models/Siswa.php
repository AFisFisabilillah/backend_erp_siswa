<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public $timestamps = false;
    protected $fillable = ["nisn",
    "nik",
    "nama_lengkap",
    "jenis_kelamin",
    "tempat_lahir",
    "tanggal_lahir",
    "jurusan",
    "agama",
    "nama_ayah",
    "nama_ibu",
    "alamat",
    "no_telp",
    "foto",
    ];
}
