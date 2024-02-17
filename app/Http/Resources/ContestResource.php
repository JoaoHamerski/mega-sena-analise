<?php

namespace App\Http\Resources;

use App\Actions\GetNumbersAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ContestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $numbers = Cache::has('mega-sena:numbers')
            ? Cache::get('mega-sena:numbers')
            : GetNumbersAction::execute();

        return [
            'concurso' => $this->concurso,
            'data' => $this->data,
            'bola_01' => $this->getNumberData($this->bola_01, $numbers),
            'bola_02' => $this->getNumberData($this->bola_02, $numbers),
            'bola_03' => $this->getNumberData($this->bola_03, $numbers),
            'bola_04' => $this->getNumberData($this->bola_04, $numbers),
            'bola_05' => $this->getNumberData($this->bola_05, $numbers),
            'bola_06' => $this->getNumberData($this->bola_06, $numbers),
        ];
    }

    public function getNumberData(int $num, Collection $numbers)
    {
        return $numbers->where('number', $num)->collapse();
    }
}
