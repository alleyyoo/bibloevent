<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'code' => 'tr',
            'name' => 'Türkçe',
            'is_active' => true,
            'is_default' => true
        ]);
    }
}
