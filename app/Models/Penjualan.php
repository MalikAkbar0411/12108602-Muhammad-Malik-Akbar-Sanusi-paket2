<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = ['kembalian', 'bayar', 'customer_id', 'date'];

    public function customer()
    {
        return $this->belongsTo(Pelanggans::class, 'customer_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'sale_id');
    }
    

    // Ubah nama relasi agar lebih deskriptif
    // public function saleDetails()
    // {
    //     return $this->hasMany(SaleDetail::class, 'penjualan_id');
    // }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
    // Jika satu penjualan memiliki satu detail penjualan
    public function saleDetail()
    {
        return $this->hasOne(SaleDetail::class, 'sale_id');
    }

    // Ubah nama relasi untuk lebih deskriptif
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
