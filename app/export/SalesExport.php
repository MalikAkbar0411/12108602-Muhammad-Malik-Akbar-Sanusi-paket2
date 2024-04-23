<?php
namespace App\Exports;

use App\Models\Penjualan;
use App\Models\SaleDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{ 
    public function collection()
    {

        $sales = Penjualan::with('saleDetails')->get();
        $exportData = [];
        foreach ($sales as $sale) {
            foreach ($sale->saleDetails as $saleDetail) {
                $exportData[] = [
                    'id' => $sale->id,
                    'Customer Name' => $sale->customer->nama,
                    'Date' => $sale->date,
                    'Product Name' => $saleDetail->product->nama,
                    'Harga Product' => $saleDetail->product->price,
                    'Quantity' => $saleDetail->quantity,
                    'Subtotal' => $saleDetail->subtotal,
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