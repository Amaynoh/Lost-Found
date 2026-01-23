<?php

namespace App\Policies;

use App\Models\Objets;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ObjetsPolicy
{
    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Objets $objets): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
     public function create(User $user): bool
    {
      return $user != null;
    }

    /**
     * Determine whether the user can update the model.
     */
     public function update(User $user, Objets $objet): bool
    {
        return $user->id === $objet->user_id || $user->role === 'admin';
    }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
     public function delete(User $user, Objets $objets): bool
    {
     return $user->id === $objets->user_id || $user->role === 'admin';
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Objets $objets): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Objets $objets): bool
    // {
    //     //
    // }
}
