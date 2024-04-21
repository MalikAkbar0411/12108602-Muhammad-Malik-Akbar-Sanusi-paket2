<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggans extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $fillable = ['nama','alamat','no_telp'];

    public function sale()
    {
        return $this->hasOne(Penjualan::class);
    }
}
