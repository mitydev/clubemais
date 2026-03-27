<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// database/seeders/SiteSettingsSeeder.php
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder {
    public function run(): void {
        SiteSetting::updateOrCreate(
            ['group' => 'footer'],
            ['data' => [
                'logo_path' => 'images/Logotipov2.svg',
                'about'     => 'Seu clube de benefícios.',
                'address'   => "Rua Exemplo, 123\nSão Paulo – SP",
                'email'     => 'contato@clube.com',
                'phone'     => '(11) 99999-9999',
                'social'    => [
                    ['icon'=>'x',         'url'=>'#'],
                    ['icon'=>'instagram', 'url'=>'#'],
                    ['icon'=>'facebook',  'url'=>'#'],
                    ['icon'=>'youtube',   'url'=>'#'],
                    ['icon'=>'tiktok',    'url'=>'#'],
                ],
                'quick_links'=> [
                    ['label'=>'O que é o Clube +', 'href'=>route('o-que-e')],
                    ['label'=>'Hotéis & Resorts',  'href'=>'#'],
                    ['label'=>'Benefícios',        'href'=>route('beneficios')],
                    ['label'=>'Parceiros',         'href'=>route('parceiros')],
                    ['label'=>'FAQs',              'href'=>'#'],
                    ['label'=>'Contato',           'href'=>'#'],
                    ['label'=>'Login e Cadastro',  'href'=>'#'],
                ],
                'newsletter' => [
                    'enabled' => true,
                    'title'   => 'Cadastre-se Agora!',
                    'text'    => 'Texto de exemplo do call-to-action.',
                    'button'  => 'Cadastre-se',
                    'placeholder' => 'Seu email',
                    'action'  => '#', // POST destino ou integração futura
                ],
            ]]
        );
    }
}

