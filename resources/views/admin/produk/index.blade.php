@extends('layouts.dashboard')

@section('title', 'Data produk')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <a href="{{ route('tambah-produk') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah
                            Produk</a>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>deskripsi</th>
                                        <th>foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produks as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->deskripsi}}</td>
                                            <td><img src="{{ asset($item->image) }}" width="60px" alt=""></td>
                                            <td>
                                                <a href="{{ route('edit-produk', ['id' => $item->id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="{{ route('hapus-produk', $item->id) }}" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
