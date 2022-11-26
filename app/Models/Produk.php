<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk');
    }
    protected $table = 'products';

}
