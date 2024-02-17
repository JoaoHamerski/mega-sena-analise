<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Contest extends Model
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
            Schema::getColumnListing('contests'),
            fn ($field) => Str::contains($field, 'bola_')
        );

        return Attribute::make(
            get: fn () => $columns
        );
    }

    public function scopeWhereContainsNumber(Builder $query, int $ballNumber): Builder
    {
        $whereClause = implode(' = ? or ', $this->ballColumns) . ' = ?';
        $whereClause = Str::replace('?', $ballNumber, $whereClause);

        $query->whereRaw("({$whereClause})");

        return $query;
    }
}
