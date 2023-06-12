<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CategorySeeder extends Seeder
{
   
    public function run(): void
    {

        $categories = [
            'income' => [
                'стипендія' => [null],
                'пенсійні виплати' => [null],
                'заробітня плата' => ['аванс', 'основна частина', 'відсоток з продажів', 'премія'],
                'дохід з банківських вкладів' => [null],
                'дохід з операцій оренди' => ['оренда квартири/будинку','авто'],
                'дохід від надання земельного паю в лізінг' => [null],
                'виграші/призи' => [null],
                'інвестиційний дохід' => ['цінні папери', 'дорогоційні метали', 'крипта'],
                'страхові виплати' => [null],
                'фінансова допомога' => [null],
                'доходи від продажу власної продукції' => [null],
                'доходи від надання послуг' => [null],
                'доходи з валютних операцій' => [null],
            ],
            'expenses' => [
                'квартплата' => ['газ', 'світло', 'вода', 'опалення', 'ЖЕК'],
                'продукти харчування' => ['хліб', 'молоко', "м'ясо", 'крупи', 'овочі', 'фрукти'],
                'медицина' => ['ліки', 'медичні послуги'],
                'авто' => ['паливо', 'технічне обслуговування','ремонтні роботи', 'запасні частини'],
                'транспорт' => ['таксі', 'автобус', 'метро'],
                'одяг' => [null],
                'спорт' => ['абонемент', 'спортивне харчування'],
                'хоббі' => [null],
                'дозвілля' => ['кафе', 'кіно', 'подорож'],
                'витрати на дитину' => ['харчування', 'одяг', 'медичний догляд', 'дит. садок', 'школа', 'хоббі'],
                'кредитні платежі' => [null],
                'орендні платежі' => [null],
            ]

        ];

        foreach ($categories as $key_group => $value_group) {

            foreach ($value_group as $key_category => $value_category) {

                for ($i = 0; $i < count($value_category); $i++) {
                    Category::factory()->count(1)->state(new Sequence (
                        ['transaction' => $key_group, 'category' => $key_category, 'subcategory' => $value_category[$i]],
                    ))->create();
                }

            }

        }

    }
    
}
