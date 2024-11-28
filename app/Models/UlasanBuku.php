<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    use HasFactory;
    protected $table='ulasan_buku';
    protected $fillable=[
        'buku_id',
        'user_id',
        'ulasan',
        'rating'
    ];
    
    public function user():BelogsTo{
        return $this->belogsTo(User::class);
    }
    public function buku():BelogsTo{
        return $this->belogsTo(Buku::class);
    }
}
