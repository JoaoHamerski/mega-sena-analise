<?php

namespace App\Models;

use Arr;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Schema;
use Str;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'date' => 'date'
    ];

    protected $appends = ['numbers'];

    public function numbers(): Attribute
    {
        $ballNumbers = Arr::only($this->getAttributes(), $this->ballColumns);
        $numbers = array_values($ballNumbers);

        return Attribute::make(
            get: fn () => $numbers
        );
    }

    public function ballColumns(): Attribute
    {
        $columns = array_filter(
            Schema::getColumnListing('games'),
            fn ($column) => Str::contains($column, 'bola')
        );

        return Attribute::make(
            get: fn () => $columns
        );
    }

    public function scopeWhereNumber(EloquentBuilder $query, $number)
    {
        $whereClause = implode(" = ? or ", $this->ballColumns) . " = ?";
        $whereClause = Str::replace('?', $number, $whereClause);

        $query->whereRaw("({$whereClause})");
    }
}
