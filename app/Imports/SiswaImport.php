<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nama_lengkap'  => $row['nama_lengkap'],
            'nisn'          => $row['nisn'],
            'nik'           => $row['nik'],
            'tempat_lahir'  => $row['tempat_lahir'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float)$row['tanggal_lahir']),
            'alamat'        => $row['alamat'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama'         => $row['agama'],
            'nama_ibu'      => $row['nama_ibu'],
            'nama_ayah'     => $row['nama_ayah'],
            'no_telp'       => $row['no_telp'],
            'jurusan'       => $row['jurusan'],
            'foto'          => null,
        ]);
    }
}
