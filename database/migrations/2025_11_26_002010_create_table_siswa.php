<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique("nisn_unique");
            $table->string("nik", 16)->unique('nik_unique');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date("tanggal_lahir");
            $table->string("jurusan");
            $table->string('agama');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string("alamat");
            $table->string("no_telp");
            $table->string("foto")->nullable();
            $table->fullText("nama_lengkap","name_search");
            $table->timestamps();
        });
    }
};
