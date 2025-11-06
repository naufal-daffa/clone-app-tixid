<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cinema_id',
        'movie_id',
        'hours',
        'price',
    ];
    // casts digunakan unutk memastikan type data nya
    protected function casts(): array
    {
        return [
            'hours' => 'array'
        ];
    }

    public function Cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function Movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
