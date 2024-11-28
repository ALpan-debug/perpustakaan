<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pinjam_id',
        'tgl_kembali',
        'denda'
    ];

    public function pinjam(): BelongsTo
    {
        return $this->belongsTo(Pinjam::class);
    }
}
