@extends('layouts.dashboard')

@section('title', 'Data produk')

@section('content')

<form action="{{ isset($produk) ? route('update-produk', $produk->id) : route('tambah-produk') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($produk))
        @method('PATCH')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($produk) ? 'Form Edit Produk' : 'Form Tambah Produk' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ isset($produk) ? $produk->nama : '' }}">
                    </div>
                        <div class="form-group">
                            <label for="price">price</label>
                            <input type="number" class="form-control" id="price" name="price"
                            value="{{ isset($produk) ? $produk->price : '' }}">
                        </div>
                            <div class="form-group">
                                <label for="stock">stock</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                value="{{ isset($produk) ? $produk->stock : '' }}">
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Masukkan Foto</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('produk') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection