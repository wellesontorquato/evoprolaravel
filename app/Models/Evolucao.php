<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    use HasFactory;

    protected $table = 'evolucoes'; // corrige pluralização automática

    protected $fillable = [
        'titulo',
        'conteudo',
        'paciente_nome',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

