<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dokumentasi;

class Asset extends Model
{
    protected $fillable = [
        'kode_aset',
        'kategori',
        'kategori_1',
        'deskripsi',
        'detail_desk',
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($asset) {
            if (empty($asset->kode_aset)) {
                $asset->kode_aset = self::generateKode();
            }
        });
    }

    public static function generateKode()
    {
        $last = self::orderBy('id', 'desc')->first();
        if (!$last) {
            return 'A0001';
        }

        // ambil angka dari kode terakhir
        $lastNumber = intval(substr($last->kode_aset, 1));
        $newNumber = $lastNumber + 1;

        return 'A' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    protected $casts = [
        'qty_sebelum' => 'integer',
        'qty_sesudah' => 'integer',
        'selisih' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // app/Models/Asset.php

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'asset_id');
    }



    public function dokumentasis()
    {
        return $this->hasMany(\App\Models\AssetDocumentation::class, 'asset_id');
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

    // App/Models/Asset.php
    public function verifikator()
    {
        return $this->belongsTo(Verifikator::class);
    }
}
