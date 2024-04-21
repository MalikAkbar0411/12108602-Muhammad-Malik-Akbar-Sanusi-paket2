@extends('layouts.dashboard')

@section('title', 'Data User')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <a href="{{route('tambah-user')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah
                        Pengguna</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($users as $user)
                                <tr>
                                    <th>{{$no++}}</th>
                                    <td>{{$user->nama}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{ route('edit', ['id' => $user->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="{{ route('hapus', $user->id) }}" class="btn btn-danger"><i
                                                class="fas fa-trash-alt"></i> Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endsection
