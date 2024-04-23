<?php
namespace App\Exports;

use App\Models\Penjualan;
use App\Models\SaleDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class SalesExport implements FromCollection, WithHeadings
{ 
    public function collection()
    {

        $sales = Penjualan::with('saleDetails')->get();
        $exportData = [];

        foreach ($sales as $sale) {
            // Pastikan $sale->customer tidak null sebelum mengakses propertinya
            $customerName = $sale->customer ? $sale->customer->nama : 'Pelanggan Tidak Tersedia';
            
            foreach ($sale->saleDetails as $saleDetail) {
                $exportData[] = [
                    'id' => $sale->id,
                    'Customer Name' => $customerName,
                    'Date' => Carbon::parse($sale->date)->format('Y-m-d H:i:s'),
                    'Product Name' => $saleDetail->product->nama,
                    'Harga Product' => $saleDetail->product->price,
                    'Quantity' => $saleDetail->quantity,
                    'Subtotal' => $saleDetail->subtotal,
                    // Lanjutkan dengan properti lainnya
                ];
            }
        }
        
                   
     return collect($exportData);
    }

    public function headings(): array
    {
        return [
            'Sale ID',
            'Customer Name',
            'Date',
            'Product Name',
            'Harga Produk',
            'Quantity',
            'Subtotal',
        ];
    }
}