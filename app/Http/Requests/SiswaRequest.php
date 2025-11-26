<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * HARUS TRUE agar request bisa diproses.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $siswaId = $this->route('siswa') ? $this->route('siswa')->id : null;

        return [

            "nama_lengkap" => "required|string",
            "nisn"=> "required|numeric|unique:siswas,nisn," . $siswaId,
            "nik" => [
                "required",
                "string",
                "numeric",
                "digits:16",
                "unique:siswas,nik," . $siswaId
            ],
            "tempat_lahir" => "required|string",
            "tanggal_lahir" => "required|date",
            "alamat" => "required|string",
            "jenis_kelamin" => "required|in:Laki-Laki,P",
            "agama" => "required|string",
            "nama_ibu" => "required|string",
            "nama_ayah" => "required|string",
            "no_telp"=> ["required","string", "regex:^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$"],
            "foto" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048", // Max 2MB
            "jurusan" => "required|string",
        ];
    }
}
