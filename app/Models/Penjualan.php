<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = ['price','customer_id','date'];

    public function customer()
    {
        return $this->belongsTo(Pelanggans::class);
    }

    public function saleDetail()
    {
        return $this->hasOne(SaleDetail::class);
    }
    public function product()
    {
        return $this->belongsTo(Produk::class);
    }
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
