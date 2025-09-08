<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';
    protected $fillable = [
        'asset_id',
        'file_path',
        'keterangan',
    ];

    public function asset()
{
    return $this->belongsTo(Asset::class, 'asset_id');
}

}
