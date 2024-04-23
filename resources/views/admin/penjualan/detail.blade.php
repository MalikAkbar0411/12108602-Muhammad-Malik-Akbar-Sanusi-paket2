@extends('layouts.dashboard')

@section('title', 'Detail Penjualan')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $index => $sale_detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sale_detail->product->nama }}</td> <!-- Menampilkan nama produk -->
                            <td>{{ $sale_detail->quantity }}</td>
                            <td>Rp {{ number_format($sale_detail->subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-12">
            <div class="form-group">
                <label for="total">Total Harga</label>
                <input type="text" class="form-control" id="total" value="{{ number_format($totalPrice, 0, ',', '.') }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="bayar">Uang Bayar</label>
                <input type="text" class="form-control" id="bayar" value="{{ number_format($bayar, 0, ',', '.') }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="kembalian">Kembalian</label>
                <input type="text" class="form-control" id="kembalian" value="{{ number_format($kembalian, 0, ',', '.') }}" readonly>
            </div>
        </div>
    <div class="card-footer">
        <a href="{{ route('pdf', $sale_detail->id)}}" class="btn btn-primary"><i class="fas fa-save"></i> Export to PDF</a>
        <a href="{{ route('penjualan') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>

</div>
@endsection
