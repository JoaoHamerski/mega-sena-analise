<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;


class MegaSenaUploadStoreController extends Controller
{
    public function __invoke(Request $request)
    {

        $path = $this->storeCsvFile($request);

        $data = collect(
            $this->getDataFromCsv(Storage::path($path))
        );

        $this->storeData($data);

        return redirect()->route('upload.show');
    }

    public function storeData(Collection $data)
    {
        $data->each(function ($item) {
            Game::firstOrCreate(
                [
                    'concurso' => $item['concurso']
                ],
                [
                    'date' => Carbon::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d'),
                    'bola_1' => $item['bola_1'],
                    'bola_2' => $item['bola_2'],
                    'bola_3' => $item['bola_3'],
                    'bola_4' => $item['bola_4'],
                    'bola_5' => $item['bola_5'],
                    'bola_6' => $item['bola_6'],
                ]
            );
        });
    }

    public function storeCsvFile(Request $request)
    {
        return $request->file->store();
    }

    public function getDataFromCsv($path)
    {
        $csv = Reader::createFromPath($path);

        $records = (Statement::create())->process($csv);
        $data = [];

        foreach ($records as $record) {
            $data[] = [
                'concurso' => $record[0],
                'data' => $record[1],
                'bola_1' => $record[2],
                'bola_2' => $record[3],
                'bola_3' => $record[4],
                'bola_4' => $record[5],
                'bola_5' => $record[6],
                'bola_6' => $record[7],
            ];
        }

        array_shift($data);

        return $data;
    }
}
