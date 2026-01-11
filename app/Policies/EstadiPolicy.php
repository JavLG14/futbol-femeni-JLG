<?php

namespace App\Policies;

use App\Models\Estadi;
use App\Models\User;

class EstadiPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'administrador';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Estadi $estadi): bool
    {
        return $user->role === 'administrador';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Estadi $estadi): bool
    {
        return $user->role === 'administrador';
    }
}
