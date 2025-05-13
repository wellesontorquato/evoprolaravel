<?php

namespace App\Policies;

use App\Models\Modelo;
use App\Models\User;

class ModeloPolicy
{
    /**
     * Permite atualizar apenas se for o dono
     */
    public function update(User $user, Modelo $modelo): bool
    {
        return $user->id === $modelo->user_id;
    }

    /**
     * Permite deletar apenas se for o dono
     */
    public function delete(User $user, Modelo $modelo): bool
    {
        return $user->id === $modelo->user_id;
    }
}
