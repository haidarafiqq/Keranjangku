<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
