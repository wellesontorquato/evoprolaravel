<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evolucoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // vínculo com usuário
            $table->string('paciente_nome'); // nome do paciente
            $table->text('conteudo');        // conteúdo da evolução
            $table->timestamps();            // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evolucoes');
    }
};
