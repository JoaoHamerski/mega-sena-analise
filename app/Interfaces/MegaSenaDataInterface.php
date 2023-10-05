<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface MegaSenaDataInterface
{
    public function storeFile($content): string;
    public function getDataFromFile(string $path): Collection;
    public function storeFileResults($file): Collection;
}
