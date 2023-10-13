<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait MegaSenaMetadataTrait
{
    public function getMetadata(array|Collection $numbers)
    {
        $occurrences = $numbers instanceof Collection
            ? $numbers->pluck('occurrences')
            : collect($numbers)->pluck('occurrences');

        return [
            'max' => $occurrences->max(),
            'min' => $occurrences->min()
        ];
    }
}
