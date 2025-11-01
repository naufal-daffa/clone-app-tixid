<?php

namespace App\Exports;

use App\Models\Movie;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Storage;

class MovieExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Movie::all();
    }
    public function headings(): Array
    {
        return [
            'No',
            'Judul',
            'Durasi',
            'Genre',
            'Sutradara',
            'Usia Minimal',
            'Poster',
            'Sinopsis'
        ];
    }
    private $rowNumber = 0;
    public function map($movie): Array
    {
        return [
            ++$this->rowNumber,
            $movie->title,
            Carbon::parse($movie->duration)->format('h') . " Jam " .Carbon::parse($movie->duration)->format('i') . " Menit ",
            $movie->genre,
            $movie->director,
            $movie->age_rating . '+',
            asset('storage/' . $movie->poster),
            $movie->description,
        ];
    }
}
