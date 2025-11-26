<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nisn'          => $row['nisn'],
            'nik'           => $row['nik'],
            'nama_lengkap'  => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir'  => $row['tempat_lahir'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']),
            'jurusan'       => $row['jurusan'],
            'agama'         => $row['agama'],
            'nama_ayah'     => $row['nama_ayah'],
            'nama_ibu'      => $row['nama_ibu'],
            'alamat'        => $row['alamat'],
            'no_telp'       => $row['no_telp'],
            'foto'          => null,
        ]);
    }
}
