<?php

namespace App\Exports;

use App\Models\Cinema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CinemaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cinema::all();
    }
    public function headings(): Array{
        return [
            "No",
            "Nama Bioskop",
            "Lokasi"
        ];
    }
    private $rowNumber = 0;
    public function map($cinema): Array{
        return [
            ++$this->rowNumber,
            $cinema->name,
            $cinema->location,
        ];
    }
}
