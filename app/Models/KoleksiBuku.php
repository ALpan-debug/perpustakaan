<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiBuku extends Model
{
    use HasFactory;
    protected $table='koleksi_buku';
    protected $fillable=[
        'buku_id',
        'user_id',
    ];
    
    public function user():BelogsTo{
        return $this->belogsTo(User::class);
    }
    public function buku():BelogsTo{
        return $this->belogsTo(Buku::class);
    }
}
