<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $guarded = [];

    // Relasi ke Buku
    public function stok()
    {
        return $this->hasOne(Stok::class, 'admin_id', 'id');
    }
}
