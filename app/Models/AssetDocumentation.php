<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDocumentation extends Model
{
    protected $table = 'dokumentasi'; // ← kasih tau nama tabel yang asli
    protected $fillable = ['asset_id', 'file_path', 'keterangan'];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}

