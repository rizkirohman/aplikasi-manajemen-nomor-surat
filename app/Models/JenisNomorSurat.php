<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisNomorSurat extends Model
{
    protected $fillable = ['jenis_nomor',];

    public function nomorSurats(): HasMany
    {
        return $this->hasMany(NomorSurat::class, 'jenis_nomor_id');
    }
}
