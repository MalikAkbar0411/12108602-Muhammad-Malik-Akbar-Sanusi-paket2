<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\SaleDetail;
use App\Models\Pelanggans;


class PenjualanController extends Controller
{
    public function penjualan()
    {
        $penjualans =Penjualan::all();
        return view('admin.penjualan.index', compact('penjualans'));
    }

    public function tambahPenjualan()
    {
        $produks = Produk::all();
        // Debug: Tampilkan isi variabel $produks
        // dd($produks);
        return view('admin.penjualan.form', compact('produks'));
    }
    

    public function simpanPenjualan(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'date' => 'required',
            'product_id' => 'required|array',
            'quantity' => 'required|array',
        ]);
    
        $totalPrice = 0; 
        foreach ($request->product_id as $key => $produkID) {
            $produk = Produk::findOrFail($produkID);
            $quantity = $request->quantity[$key];
            $subtotal = $produk->price * $quantity;
            $totalPrice += $subtotal; 
        }
    
        $pelanggan = Pelanggans::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ]);
    
        $penjualan = Penjualan::create([
            'price'=>$totalPrice,
            'customer_id'=>$pelanggan->id,
            'date'=>$request->date,
        ]);
    
        foreach ($request->product_id as $key => $produkID) {
            $produk = Produk::findOrFail($produkID);
            $quantity = $request->quantity[$key];
            $subtotal = $produk->price * $quantity;
            $DetailPembelian = SaleDetail::create([
                'sale_id' => $penjualan->id,
                'product_id' => $produkID,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
            // Kurangi stok produk
            $produk->stock -= $quantity;
            $produk->save();
        }
    
        return redirect()->route('penjualan')->with('success', 'Data penjualan berhasil disimpan.');
    }
    

    public function detailSale($id)
{
    $sale_details = SaleDetail::where('sale_id', $id)->get();
    return view('admin.penjualan.detail', compact('sale_details'));
}

// public function cetakPegawai()
// {
//     $penjualans =Penjualan::get();
//     return view('admin.penjualan.cetak', compact('penjualans'));
// }
} 
