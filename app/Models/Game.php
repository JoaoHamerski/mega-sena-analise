<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'concurso',
        'data',
        'bola_01',
        'bola_02',
        'bola_03',
        'bola_04',
        'bola_05',
        'bola_06',
    ];

    public function ballColumns(): Attribute
    {
        $columns = array_filter(
            Schema::getColumnListing('games'),
            fn ($field) => Str::contains($field, 'bola_')
        );

        return Attribute::make(
            get: fn () => $columns
        );
    }

    public function scopeWhereBall(Builder $query, int $ballNumber)
    {
        $whereClause = implode(' = ? or ', $this->ballColumns) . ' = ?';
        $whereClause = Str::replace('?', $ballNumber, $whereClause);

        $query->whereRaw("({$whereClause})");
    }
}
