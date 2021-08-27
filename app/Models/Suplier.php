<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'suplier';

    protected $guarded = [];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'produk_id', 'id');
    }
}
