<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dokumentasi;

class Asset extends Model
{
    protected $fillable = [
        'kode_aset',
        'kategori_id',
        'deskripsi',
        'lokasi',
        'unit_pengguna',
        'qty_sebelum',
        'qty_sesudah',
        'selisih',
        'kondisi',
        'catatan',
        'user_id',
        'unit_id',
    ];

    protected $casts = [
        'qty_sebelum' => 'integer',
        'qty_sesudah' => 'integer',
        'selisih' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'asset_id');
    }

    // Opsional: otomatis hitung selisih
    public function getSelisihAttribute($value)
    {
        return $this->qty_sesudah - $this->qty_sebelum;
    }

    // App/Models/Asset.php
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
