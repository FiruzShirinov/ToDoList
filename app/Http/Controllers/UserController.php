<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListUnit;
use App\Traits\AjaxableTrait;

class UserController extends Controller
{
    use AjaxableTrait;

    public function getAvailableUsers(ListUnit $listUnit)
    {
        if ($this->isAjaxRequest()) {
            $listUnitUserIds = $listUnit->sharedWithUsers()->pluck('id');
            $userIds = $listUnitUserIds->push(auth()->user()->id);
            return User::whereNotIn('id', $userIds->all())->get(['id', 'name']);
        }
    }
}
