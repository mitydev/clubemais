<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('destinations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('destination_group_id')->nullable()->constrained()->nullOnDelete();
            $t->integer('position')->default(0)->index();
            $t->string('title', 180);
            $t->string('excerpt', 255)->nullable();    
            $t->string('link_url', 500)->nullable();
            $t->string('image_path')->nullable();
            $t->boolean('is_active')->default(true)->index();
            $t->timestamp('starts_at')->nullable()->index();
            $t->timestamp('ends_at')->nullable()->index();
            $t->json('meta')->nullable();
            $t->timestamps();

            $t->index(['destination_group_id', 'position']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('destinations');
    }
};
