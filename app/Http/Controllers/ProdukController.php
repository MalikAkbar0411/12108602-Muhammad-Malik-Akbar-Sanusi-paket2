<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function produk()
    {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));
    }

    public function tambahProduk()
    {
        return view('admin.produk.form');
    }

    public function simpanProduk(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $input = $request->all();
        if($image = $request->file('image')){
            $profileImage = date('YmdHis') .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $profileImage);
            $input['image'] = 'upload/' . $profileImage;
        }

        Produk::create($input);
        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui!');

    }


    public function editProduk($id)
    { {
            $produk = Produk::findOrFail($id);
            return view('admin.produk.form', compact('produk'));
        }
    }

    public function updateProduk(Request $request, $id)
    { {
            // Temukan produk yang akan diedit berdasarkan ID
            $produk = Produk::findOrFail($id);

            // Validasi input dari formulir pengeditan
            $request->validate([
                'nama' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'deskripsi' => 'required'
            ]);

            // Perbarui atribut produk dengan nilai baru dari formulir
            $produk->nama = $request->nama;
            $produk->price = $request->price;
            $produk->stock = $request->stock;
            $produk->deskripsi = $request->deskripsi;

            // Simpan perubahan ke dalam database
            $produk->save();

            // Redirect pengguna kembali ke halaman produk dengan pesan sukses

            // Redirect ke halaman produk atau halaman lain yang sesuai
            return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui!');

        }
    }

    public function hapusProduk($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->delete();
        }
        return redirect()->route('produk');
    }
    
}
