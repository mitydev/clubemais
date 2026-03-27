<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_section_destination', function (Blueprint $t) {
            $t->id();

            $t->foreignId('page_section_id')
              ->constrained('page_sections')
              ->cascadeOnDelete();

            $t->foreignId('destination_id')
              ->constrained('destinations')
              ->cascadeOnDelete();

            $t->unsignedInteger('position')->default(0);

            $t->timestamps();

            $t->unique(['page_section_id','destination_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_destination');
    }

};
