<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use  HasApiTokens;
    protected $table = 'admins';
    protected $fillable = ["username", "password","profile", "fullname"];
    public $timestamps = true;
}
