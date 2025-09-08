<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; // nama tabel

    protected $fillable = [
        'nama',
    ];

    // App/Models/Kategori.php
public function assets()
{
    return $this->hasMany(Asset::class, 'kategori_id');
}

}
