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
        Schema::create('banners', function (Blueprint $t) {
            $t->id();

            // obrigatório + FK (ajuste para nullable() se ainda não puder exigir)
            $t->foreignId('group_banner_id')
            ->constrained('group_banners')
            ->cascadeOnDelete();

            // ordenação no grupo
            $t->unsignedInteger('position')->default(10);

            $t->string('title')->nullable();     // opcional (cai no nome do arquivo)
            $t->string('image_path');            // caminho no disk 'public'
            $t->string('link_url')->nullable();  // link por imagem
            $t->string('alt_text')->nullable();  // acessibilidade
            $t->boolean('is_active')->default(true);
            $t->timestamp('starts_at')->nullable();
            $t->timestamp('ends_at')->nullable();
            $t->timestamps();

            // Índices práticos
            $t->index(['group_banner_id', 'position'], 'banners_group_position_idx');
            $t->index(['is_active', 'starts_at', 'ends_at'], 'banners_active_schedule_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
