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
    <form action="{{ isset($penjualan) ? route('update-penjualan', $penjualan->id) : route('tambah-penjualan') }}"
        method="post">
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
                            <input type="text" class="form-control" id="name" name="nama"
                                value="{{ old('nama', isset($penjualan) ? $penjualan->nama : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ old('alamat', isset($penjualan) ? $penjualan->alamat : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                value="{{ old('no_telp', isset($penjualan) ? $penjualan->no_telp : '') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" id="date" name="date"
                            value="{{ old('date', isset($penjualan) ? date('Y-m-d\TH:i:s', strtotime('+1 hour', strtotime($penjualan->date))) : '') }}"
                            required>
                         
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
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}" data-price="{{ $produk->price }}">
                                                {{ $produk->nama }} - {{ $produk->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Jumlah Beli</label>
                                    <input type="number" class="form-control quantity" id="quantity" name="quantity[]"
                                        value="{{ old('quantity') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addpenjualanItem"><i
                            class="fas fa-plus"></i></button>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($penjualan) ? 'Form Edit pembelian' : 'Pembayaran' }}
                        </h6>
                    </div>
                    <div class="card-footer">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="total">Total Harga</label>
                                <!-- Tampilkan total harga di sini -->
                                <input type="text" class="form-control" id="total" name="price"
                                    value="{{ isset($totalPrice) ? number_format($totalPrice, 2, ',', '.') : '' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bayar">Uang Bayar</label>
                                <input type="text" class="form-control" id="bayar" name="bayar" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="kembalian">Kembalian</label>
                                <input type="text" class="form-control" id="kembalian"
                                    value="{{ isset($kembalian) ? 'Rp ' . number_format($kembalian, 2, ',', '.') : '' }}"
                                    readonly>
                                @if (session('error'))
                                    <span class="text-danger">{{ session('error') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    <script>
        document.getElementById('addpenjualanItem').addEventListener('click', function() {
    var penjualanForm = document.getElementById('penjualanForm');
    var newPenjualanItem = penjualanForm.cloneNode(true);
    penjualanForm.parentNode.insertBefore(newPenjualanItem, penjualanForm.nextSibling);
});

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function hitungTotalHarga() {
    var total = 0;
    var quantities = document.querySelectorAll('.quantity');
    var prices = JSON.parse('<?php echo json_encode($produks->pluck('price', 'id')); ?>');
    quantities.forEach(function(quantityInput) {
        var productId = quantityInput.closest('.row').querySelector('select').value;
        var price = prices[productId];
        var quantity = parseFloat(quantityInput.value);
        if (!isNaN(price) && !isNaN(quantity)) {
            total += price * quantity;
        }
    });
    return total;
}

function updateTotalAndKembalian() {
    var total = parseFloat(hitungTotalHarga());
    var uangBayar = parseFloat(document.getElementById('bayar').value);
    var kembalian = uangBayar - total;
    document.getElementById('total').value = formatNumber(total.toFixed(2));
    document.getElementById('kembalian').value = formatNumber(kembalian.toFixed(2));
}

document.addEventListener('input', function(event) {
    if (event.target && event.target.classList.contains('quantity')) {
        updateTotalAndKembalian();
    }
});

document.getElementById('bayar').addEventListener('input', function() {
    updateTotalAndKembalian();
});

window.onload = function() {
    updateTotalAndKembalian();
};

    </script>
@endsection
