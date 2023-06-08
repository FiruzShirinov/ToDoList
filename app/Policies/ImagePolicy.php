<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\ListItem;
use App\Models\User;

class ImagePolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Image $image, ListItem $listItem): bool
    {
        return $user->is(auth()->user())
            && ($user->is($listItem->listUnit->user)
                || $listItem->listUnit->sharedWithUsers->contains('id', $user->id))
            && $image->is($listItem->image);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Image $image, ListItem $listItem): bool
    {
        return $user->is(auth()->user())
            && ($user->is($listItem->listUnit->user)
                || $listItem->listUnit->sharedWithUsers->contains('id', $user->id))
            && $image->is($listItem->image);
    }
}
