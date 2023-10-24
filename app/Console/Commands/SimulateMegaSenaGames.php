<?php

namespace App\Console\Commands;

use App\Models\Game;
use Arr;
use Illuminate\Console\Command;

class SimulateMegaSenaGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:simulate-mega-sena-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulate a mega sena competition.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $found = false;
        $count = 1;
        $gameNumbers = Game::orderBy('date', 'desc')->first()->numbers;

        while (!$found) {
            $generatedNumbers = $this->generateNumbers();

            $this->info($this->formatInfo($generatedNumbers, $count++));

            if ($this->numbersMatch($gameNumbers, $generatedNumbers)) {
                $found = true;
            }
        }

        $this->info('JOGO ENCONTRADO!');
    }

    public function numbersMatch(array $arr1, array $arr2)
    {
        return count(array_intersect($arr1, $arr2)) === 6;
    }

    public function getGame($numbers)
    {
        return Game::where(
            $this->formatNumbersForQuery($numbers)
        )->first();
    }

    public function suffixZero(int $num)
    {
        return $num < 10 ? '0' . $num : $num;
    }

    public function formatNumbersForQuery($numbers)
    {
        return Arr::mapWithKeys(
            $numbers,
            fn ($num, $index) => [
                ('bola_' . $index + 1) => $num
            ]
        );
    }

    public function gameExists($numbers)
    {
        $numbersQuery = $this->formatNumbersForQuery($numbers);

        return Game::where($numbersQuery)->exists();
    }

    public function formatInfo($numbers, $count)
    {
        $numbers = Arr::map($numbers, fn ($num) => $this->suffixZero($num));
        $numbers = implode(' | ', $numbers);

        return "[{$numbers}] = $count";
    }

    public function generateNumbers()
    {
        $faker = fake();
        $faker->unique(true);

        $result = [
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
            $faker->unique()->numberBetween(1, 60),
        ];

        sort($result);

        return $result;
    }
}
