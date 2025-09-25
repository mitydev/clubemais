<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;
use App\Models\Local;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $praia = Term::firstOrCreate(['slug' => 'praia'], ['name' => 'Praia']);
        $campo = Term::firstOrCreate(['slug' => 'campo'], ['name' => 'Campo']);

        Local::firstOrCreate(['slug' => 'wanderlust-experience'], [
            'name' => 'Wanderlust Experience Hotel',
            'description' => "Hotel conceito perto do mar.\nCafé da manhã incluso.",
            'term_id' => $praia->id,
        ]);

        Local::firstOrCreate(['slug' => 'vivant-eco-beach'], [
            'name' => 'Vivant Eco Beach',
            'description' => "Eco resort pé na areia.",
            'term_id' => $praia->id,
        ]);

        Local::firstOrCreate(['slug' => 'fazenda-poehma'], [
            'name' => 'Fazenda Poehma',
            'description' => "Experiência rural completa.",
            'term_id' => $campo->id,
        ]);
    }
}
