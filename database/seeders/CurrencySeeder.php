<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CurrencySeeder extends Seeder
{
    
    public function run(): void
    {

        Currency::factory()
                ->count(3)
                ->state(new Sequence(
                    ['currency' => 'HRN'],
                    ['currency' => 'USD'],
                    ['currency' => 'EUR']
                ))
                ->create();
        
    }
        

}
