<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;

class PartitPolicy
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
    public function view(?User $user, Partit $partit): bool
    {
        return true;
    }

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
    public function update(User $user, Partit $partit): bool
    {
        // Only the specific referee assigned to the match
        return $user->role === 'arbitre' && $user->id === $partit->arbitre_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partit $partit): bool
    {
        return $user->role === 'administrador';
    }
}
