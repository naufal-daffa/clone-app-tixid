<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScheduleExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Schedule::all();
    }
    public function headings(): array{
        return [
            'No',
            'Nama Bioskop',
            'Judul Film',
            'Harga',
            'Jam Tayang',
        ];
    }
    private $rowNumber = 0;
    public function map($schedule): Array{
        return [
            ++$this->rowNumber,
            $schedule->cinema->name,
            $schedule->movie->title,
            $schedule->price,
            array_merge($schedule->hours)
        ];
    }
}
