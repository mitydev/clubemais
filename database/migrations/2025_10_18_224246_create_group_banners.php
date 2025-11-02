<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('group_banners', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nome exibido no admin
            $table->string('slug')->unique();       // Ex.: home-hero (único)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_banners');
    }
};
