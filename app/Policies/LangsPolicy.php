<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Langs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LangsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::DEVELOPER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Langs $langs): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::DEVELOPER]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::DEVELOPER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Langs $langs): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::DEVELOPER]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Langs $langs): bool
    {
        return $user->role === UserRole::DEVELOPER;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Langs $langs): bool
    {
        return $user->role === UserRole::DEVELOPER;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Langs $langs): bool
    {
        return $user->role === UserRole::DEVELOPER;
    }
}
