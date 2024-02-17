<?php

namespace App\Actions;

use App\Models\Contest;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Shuchkin\SimpleXLSX;

class UpdateMegaSenaContestsAction
{
    protected static $CONTESTS_FILE_PATH = 'contests/contest.xlsx';
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
        Storage::put(static::$CONTESTS_FILE_PATH, $content);

        return Storage::path(static::$CONTESTS_FILE_PATH);
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
            fn ($contest) => static::firstOrCreateContest($contest)
        );
    }

    public static function firstOrCreateContest(array $contest): Contest
    {
        return Contest::query()->firstOrCreate(
            ['concurso' => $contest[0]],
            [
                'data' => Carbon::createFromFormat('d/m/Y', $contest[1]),
                'bola_01' => $contest[2],
                'bola_02' => $contest[3],
                'bola_03' => $contest[4],
                'bola_04' => $contest[5],
                'bola_05' => $contest[6],
                'bola_06' => $contest[7],
            ]
        );
    }
}
