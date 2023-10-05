<?php

namespace App\Helpers;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Shuchkin\SimpleXLSX;

class MegaSenaHelper
{
    public static function storeData(Collection $data): Collection
    {
        $games = collect();

        $data->each(function ($item) use ($games) {
            if (Game::where('concurso', $item['concurso'])->exists()) {
                return;
            }

            $games->push(
                Game::create([
                    'concurso' => $item['concurso'],
                    'date' => Carbon::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d'),
                    'bola_1' => $item['bola_1'],
                    'bola_2' => $item['bola_2'],
                    'bola_3' => $item['bola_3'],
                    'bola_4' => $item['bola_4'],
                    'bola_5' => $item['bola_5'],
                    'bola_6' => $item['bola_6'],
                ])
            );
        });

        return $games;
    }

    public static function getDataFromAsLoteriasFile(string $path)
    {
        $data = collect();
        $xlsx = SimpleXLSX::parse($path)->rows();
        $records = array_slice($xlsx, 7);

        foreach ($records as $record) {
            $data->push([
                'concurso' => $record[0],
                'data' => $record[1],
                'bola_1' => $record[2],
                'bola_2' => $record[3],
                'bola_3' => $record[4],
                'bola_4' => $record[5],
                'bola_5' => $record[6],
                'bola_6' => $record[7],
            ]);
        }

        return collect($data);
    }
}
