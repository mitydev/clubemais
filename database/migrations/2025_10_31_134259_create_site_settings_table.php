<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('site_settings', function (Blueprint $t) {
            $t->id();
            $t->string('group')->index();                 // ex.: 'footer'
            $t->json('data');                             // payload flexível
            $t->timestamps();
            $t->unique('group');
        });
    }
    public function down(): void { Schema::dropIfExists('site_settings'); }
};
