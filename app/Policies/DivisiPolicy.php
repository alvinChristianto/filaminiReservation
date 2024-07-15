<?php

namespace App\Policies;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DivisiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_divisi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Divisi $divisi): bool
    {
        return $user->can('view_divisi');
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_divisi');
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Divisi $divisi): bool
    {
        return $user->can('update_divisi');
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Divisi $divisi): bool
    {
        //
        return $user->can('delete_divisi');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Divisi $divisi): bool
    {
        //
        
        return $user->can('restore_divisi');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Divisi $divisi): bool
    {
        //
        
        return $user->can('force_delete_divisi');
    }
}
