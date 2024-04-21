@extends('layouts.dashboard')

@section('title', isset($penjualan) ? 'Form Edit Penjualan' : 'Form Tambah Penjualan')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <form action="{{ isset($penjualan) ? route('update-penjualan', $penjualan->id) : route('tambah-penjualan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($penjualan) ? 'Form Edit Penjualan' : 'Form Tambah Penjualan' }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="name" name="nama" value="{{ old('nama', isset($penjualan) ? $penjualan->nama : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', isset($penjualan) ? $penjualan->alamat : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', isset($penjualan) ? $penjualan->no_telp : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', isset($penjualan) ? $penjualan->date->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Pilih Produk
                        </h6>
                    </div>
                    <div class="card-body" id="penjualanForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="produk">Produk</label>
                                    <select class="form-control" id="produk" name="product_id[]" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Jumlah Beli</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity[]" value="{{ old('quantity') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addpenjualanItem"><i class="fas fa-plus"></i></button>

                    <script>
                        document.getElementById('addpenjualanItem').addEventListener('click', function() {
                            var penjualanForm = document.getElementById('penjualanForm');
                            var newpenjualanItem = penjualanForm.cloneNode(true);
                            
                            // Menambahkan identifikasi unik ke ID elemen yang di-klon
                            var randomId = Math.random().toString(36).substr(2, 9); // Menghasilkan ID acak
                            newpenjualanItem.id = 'penjualanForm_' + randomId;
                            var produkSelect = newpenjualanItem.querySelector('#produk');
                            var quantityInput = newpenjualanItem.querySelector('#quantity');
                            produkSelect.id = 'produk_' + randomId;
                            quantityInput.id = 'quantity_' + randomId;
                            
                            penjualanForm.parentNode.insertBefore(newpenjualanItem, this);
                        });
                    </script>
                    

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('penjualan') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
