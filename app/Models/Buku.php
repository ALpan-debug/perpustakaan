<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Buku extends Model
{
    use HasFactory;

    protected $fillable=['judul','penulis','penerbit','isbn','tahun','jumlah'];

    public function kategoriRelasi(): hasMany
    {
        return $this->hasMany(kategoriRelasi::class);
    }
    public function peminjaman()
    {
        return $this->hasMany(Pinjam::class, 'user_id');
    }
    //public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class);
    // }
}
