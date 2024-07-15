<?php

namespace App\Policies;

use App\Models\TipePengajuan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipePengajuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        
        return $user->can('view_any_tipe::pengajuan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TipePengajuan $tipePengajuan): bool
    {
        
        return $user->can('view_tipe::pengajuan');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        
        return $user->can('create_tipe::pengajuan');
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TipePengajuan $tipePengajuan): bool
    {
     
        
        return $user->can('update_tipe::pengajuan');   //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TipePengajuan $tipePengajuan): bool
    {
        
        return $user->can('delete_tipe::pengajuan');
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TipePengajuan $tipePengajuan): bool
    {
     
        return $user->can('restore_tipe::pengajuan');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TipePengajuan $tipePengajuan): bool
    {
        return $user->can('force_delete_tipe::pengajuan');
    }
}
