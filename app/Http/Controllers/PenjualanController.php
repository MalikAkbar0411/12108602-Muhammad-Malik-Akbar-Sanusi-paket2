<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\SaleDetail;
use App\Models\Pelanggans;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function penjualan()
    {
        $penjualans = penjualan::all();
        $totalPrices = [];
        foreach ($penjualans as $penjualan) {
            $totalPrices[$penjualan->id] = SaleDetail::where('sale_id', $penjualan->id)->sum('subtotal');
        }

        return view('admin.penjualan.index', compact('penjualans', 'totalPrices'));
    }

 public function tambahPenjualan()
{
    $produks = Produk::all();
    // Hitung total harga produk yang dipilih

    $totalPrice = 0;
    foreach ($produks as $produk) {
        $totalPrice += $produk->price * $produk->quantity;
    }
    return view('admin.penjualan.form', compact('produks', 'totalPrice'));
}

    
public function simpanPenjualan(Request $request){
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'date' => 'required',
        'product_id' => 'required|array',
        'quantity' => 'required|array',
        'bayar' => 'required|numeric', //Tambahkan validasi untuk 'bayar'
    ]);

    // Buat penjualan
    $pelanggan = Pelanggans::create([
        'nama'=>$request->nama,
        'alamat'=>$request->alamat,
        'no_telp'=>$request->no_telp,
    ]);

    $penjualan = Penjualan::create([
        'customer_id'=>$pelanggan->id,
        'date'=>$request->date,
        'bayar' => $request->bayar,
        'kembalian' => $request->kembalian,
    ]);
    
    $totalPrice = 0;
    foreach ($request->product_id as $key => $productId) {
        $product = Produk::findOrFail($productId);
        $subtotal = $product->price * $request->quantity[$key];
        $saleDetail = SaleDetail::create([
            'sale_id' => $penjualan->id,
            'product_id' => $productId,
            'quantity' => $request->quantity[$key],
            'subtotal' => $subtotal,
        ]);

        $totalPrice += $subtotal;

        $product->stock -= $request->quantity[$key];
        $product->save();
    }

    $kembalian = $request->bayar - $totalPrice;
    $penjualan->update(['kembalian' => $kembalian]);


    // Hitung kembalian
    $kembalian = $request->bayar - $totalPrice;
    
    // Update harga total pada penjualan
    $penjualan->update(['price' => $totalPrice]);

    // Update kembalian pada penjualan
    $penjualan->update(['kembalian' => $kembalian]);

    return redirect()->route('sale.detail', ['id' => $penjualan->id, 'bayar' => $request->bayar, 'kembalian' => $kembalian])
        ->with('success', 'Data penjualan berhasil disimpan.');
}


    
    public function detailSale($id)
{
    $sales = SaleDetail::where('sale_id', $id)->get();

    $totalPrice = $sales->sum('subtotal');
    $sale = penjualan::findOrFail($id);
    $bayar = $sale->bayar;
    $kembalian = $sale->kembalian;
    return view('admin.penjualan.detail', compact('sales', 'totalPrice', 'bayar', 'kembalian'));
    // $sale_details = SaleDetail::where('sale_id', $id)->get();
    // return view('admin.penjualan.detail', compact('sale_details'));
}

// public function cetakPegawai()
// {
//     $penjualans =Penjualan::get();
//     return view('admin.penjualan.cetak', compact('penjualans'));
// }

public function exportPDF($id)
{
    // Tambahkan ini untuk memeriksa ID yang diterima

    // Ambil data penjualan berdasarkan ID yang diberikan
    $penjualan = Penjualan::findOrFail($id);

    // Pastikan penjualan ditemukan
    if ($penjualan) {
        // Ambil detail penjualan berdasarkan penjualan
        $detailPenjualan = $penjualan->saleDetails;

        // Pastikan detail penjualan tidak null dan tidak kosong
        if (!is_null($detailPenjualan) && $detailPenjualan->isNotEmpty()) {
            // Hitung total harga
            $totalHarga = 0;
            foreach ($detailPenjualan as $detail) {
                $totalHarga += $detail->subtotal;
            }

            // Render blade view ke dalam string
            $html = view('pdf', compact('penjualan', 'detailPenjualan', 'totalHarga'))->render();

            // Inisialisasi objek PDF
            $pdf = new Dompdf();
            $options = new Options();
            $options->setIsHtml5ParserEnabled(true);
            $pdf->setOptions($options);

            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            // Simpan file PDF ke dalam folder public/pdf/
            $output = $pdf->output();
            $filePath = public_path('pdf/sale_' . $id . '.pdf');
            
            // Tambahkan ini untuk memeriksa URL file PDF yang akan disimpan
            
            file_put_contents($filePath, $output);

            // Redirect ke URL PDF yang telah dibuat
            return redirect('pdf/sale_' . $id . '.pdf');
        } else {
            // Jika detail penjualan kosong
            return response()->json(['message' => 'Detail penjualan tidak ditemukan atau kosong'], 404);
        }
    } else {
        // Jika penjualan tidak ditemukan
        return response()->json(['message' => 'Penjualan tidak ditemukan'], 404);
    }
}

}


