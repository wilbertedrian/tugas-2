<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $guarded = [];

    // Relasi ke Penerbit
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

}
