<?php

namespace App\Actions;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Shuchkin\SimpleXLSX;

class UpdateMegaSenaGamesAction
{
    protected static $GAMES_FILE_PATH = 'games/games.xlsx';
    protected static $REMOTE_FILE_URL = 'https://asloterias.com.br/download_excel.php';

    public static function execute(): Collection
    {
        $file = static::fetchResultsFile();
        $filepath = static::storeFile($file);
        $results = static::getResultsFromXlsx($filepath);

        return static::insertResults($results);
    }

    public static function fetchResultsFile(): bool | string
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'l' => 'ms',
                    't' => 't',
                    'o' => 's',
                    'f1' => '',
                    'f2' => ''
                ])
            ]
        ]);

        return file_get_contents(static::$REMOTE_FILE_URL, false, $context);
    }

    public static function storeFile($content): string
    {
        Storage::put(static::$GAMES_FILE_PATH, $content);

        return Storage::path(static::$GAMES_FILE_PATH);
    }

    public static function getResultsFromXlsx(string $filepath): Collection
    {
        $xlsx = SimpleXLSX::parse($filepath)->rows();
        $records = static::stripXlsxHeader($xlsx);

        return collect($records);
    }

    public static function stripXlsxHeader($xlsx): array
    {
        return array_slice($xlsx, 7);
    }

    public static function insertResults(Collection $results): Collection
    {
        return $results->map(
            fn($game) => static::firstOrCreateGame($game)
        );
    }

    public static function firstOrCreateGame(array $game): Game
    {
        return Game::query()->firstOrCreate(
            ['concurso' => $game[0]],
            [
                'data' => Carbon::createFromFormat('d/m/Y', $game[1]),
                'bola_01' => $game[2],
                'bola_02' => $game[3],
                'bola_03' => $game[4],
                'bola_04' => $game[5],
                'bola_05' => $game[6],
                'bola_06' => $game[7],
            ]
        );
    }
}
