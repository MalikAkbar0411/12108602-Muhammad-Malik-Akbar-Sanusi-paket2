@extends('layouts.dashboard')

@section('title', 'Edit Produk')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('update-produk', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Form Edit Produk
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $produk->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $produk->price }}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $produk->stock }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $produk->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Masukkan Foto</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    </div>
                    @if ($produk->image)
                        <div class="form-group">
                            <label>Gambar Saat Ini:</label><br>
                            <img src="{{ asset($produk->image) }}" width="100" alt="Gambar Produk">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('produk') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</form>

@endsection
