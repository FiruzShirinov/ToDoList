<?php

namespace App\Policies;

use App\Models\ListItem;
use App\Models\ListUnit;
use App\Models\User;

class ListItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, ListUnit $listUnit): bool
    {
        return $user->is(auth()->user()) && ($user->is($listUnit->user) || $listUnit->sharedWithUsers->contains('id', $user->id));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, ListUnit $listUnit): bool
    {
        return $user->is(auth()->user()) && $user->is($listUnit->user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ListUnit $listUnit, ListItem $listItem): bool
    {
        return $user->is(auth()->user()) && $user->is($listUnit->user) && $listUnit->is($listItem->listUnit);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ListUnit $listUnit, ListItem $listItem): bool
    {
        return $user->is(auth()->user()) && $user->is($listUnit->user) && $listUnit->is($listItem->listUnit);
    }
}
