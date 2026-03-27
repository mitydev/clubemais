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
        Schema::create('page_section_banner', function (Blueprint $t) {
            $t->id();
            $t->foreignId('page_section_id')->constrained()->cascadeOnDelete();
            $t->foreignId('banner_id')->constrained()->cascadeOnDelete();

            $t->unsignedInteger('position')->default(0);   // ordem no slider da seção
            $t->string('caption')->nullable();
            $t->string('link_url_override')->nullable();    // opcional: link diferente só nesta seção
            $t->timestamps();

            // evita duplicar o mesmo banner na mesma seção
            $t->unique(['page_section_id', 'banner_id'], 'sec_banner_unique');

            // ajuda a ordenar/consultar rápido
            $t->index(['page_section_id', 'position'], 'sec_pos_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_section_banner');
    }
};
