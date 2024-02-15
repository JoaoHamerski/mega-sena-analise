<?php

namespace App\Actions;

class GetMetadataAction
{
    public static function execute(array $occurrences = null): array
    {
        if (!$occurrences) {
            $occurrences = GetOccurrencesAction::execute();
        }

        return [
            'occurrences' => [
                'max' => max($occurrences),
                'min' => min($occurrences)
            ]
        ];
    }
}
