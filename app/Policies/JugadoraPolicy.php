<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;

class JugadoraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Jugadora $jugadora): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin only
        return $user->role === 'administrador';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jugadora $jugadora): bool
    {
        // Admin or the Manager of the team the player belongs to
        return $user->role === 'administrador' ||
            ($user->role === 'manager' && $user->equip_id === $jugadora->equip_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Jugadora $jugadora): bool
    {
        // Admin or the Manager of the team the player belongs to
        return $user->role === 'administrador' ||
            ($user->role === 'manager' && $user->equip_id === $jugadora->equip_id);
    }
}
