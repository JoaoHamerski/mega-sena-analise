<?php

namespace App\Http\Controllers;

use App\Helpers\MegaSenaHelper;
use App\Interfaces\MegaSenaDataInterface;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


class MegaSenaStoreController extends Controller implements MegaSenaDataInterface
{
    public function __invoke(Request $request)
    {
        $file = $request->file;
        $filepath = $this->storeFile(File::get($file->getRealPath()));
        $data = $this->getDataFromFile($filepath);

        $this->storeFileResults($data);

        return redirect()->route('upload.show');
    }

    public function storeFile($content): string
    {
        $filepath = 'games/all-games.xlsx';

        Storage::put($filepath, $content);

        return $filepath;
    }

    public function getDataFromFile(string $path): Collection
    {
        return MegaSenaHelper::getDataFromAsLoteriasFile(
            storage_path('app/' . $path)
        );
    }

    public function storeFileResults($file): Collection
    {
        return MegaSenaHelper::storeData($file);
    }
}
