@extends('layouts.dashboard')

@section('title', 'Data produk')

@section('content')


@endif
<form action="{{ isset($user) ? route('update', $user->id) : route('tambah-user') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($user))
        @method('PATCH')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($user) ? 'Form Edit User' : 'Form Tambah User' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ isset($user) ? $user->nama : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="admin" {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ isset($user) && $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ isset($user) ? $user->email : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                        value="{{isset($user) ? $user->password: ''}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('user') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
