<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_user_model extends Model
{
    use HasFactory;
    protected $table = 'data_user';
    protected $fillable = ['name', 'email', 'password', 'role', 'status_login'];

    protected $casts = [
        'status_login' => 'boolean',
    ];
}