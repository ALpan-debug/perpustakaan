<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class KategoriRelasi extends Model
{
    use HasFactory;
    protected $table='kategori_relasi';
    protected $primaryKey='id';
    protected $fillable=['id','kategori_id','buku_id'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(kategori::class);
    }
}

