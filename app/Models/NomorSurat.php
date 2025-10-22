<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NomorSurat extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_nomor_id',
        'tanggal',
        'nomor_start',
        'nomor_end',
        'kodefikasi_surat',
        'perihal_surat',
        'tujuan_surat',
    ];

    public function jenisNomor(): BelongsTo
    {
        return $this->belongsTo(JenisNomorSurat::class, 'jenis_nomor_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
