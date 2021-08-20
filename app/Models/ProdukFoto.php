<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukFoto extends Model
{
    use HasFactory;

    protected $table = 'produk_foto';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
