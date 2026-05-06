<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Tambahkan 'logo_path' ke dalam array fillable
    protected $fillable = ['name', 'slug', 'logo_path', 'banner_path', 'description', 'is_active'];
}