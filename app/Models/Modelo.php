<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'conteudo',
    ];

    // ✅ Relacionamento com usuário (dono do modelo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

