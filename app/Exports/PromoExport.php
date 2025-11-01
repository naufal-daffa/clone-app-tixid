<?php

namespace App\Exports;

use App\Models\Promo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PromoExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Promo::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Promo',
            'Total Potongan'
        ];
    }

    private $rowNumber = 0;

    public function map($promo): array
    {
        $discount = $promo->discount;
        if ($promo->type === 'percent') {
            $discount = $discount . '%';
        } else {
            $discount = 'Rp. ' . number_format($discount, 0, ',', '.');
        }

        return [
            ++$this->rowNumber,
            $promo->promo_code,
            $discount,
        ];
    }
}
