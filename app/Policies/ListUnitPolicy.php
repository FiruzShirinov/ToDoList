<?php

namespace App\Policies;

use App\Models\ListUnit;
use App\Models\User;

class ListUnitPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is(auth()->user());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ListUnit $listUnit): bool
    {
        return $user->is(auth()->user()) && $user->is($listUnit->user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ListUnit $listUnit): bool
    {
        return $user->is(auth()->user()) && $user->is($listUnit->user);
    }
}
