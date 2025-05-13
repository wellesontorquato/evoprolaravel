<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evolucoes', function (Blueprint $table) {
            $table->string('modelo_nome')->nullable()->after('paciente_nome');
        });
    }

    public function down(): void
    {
        Schema::table('evolucoes', function (Blueprint $table) {
            $table->dropColumn('modelo_nome');
        });
    }

};
