<?php

namespace App\Traits;

trait AjaxableTrait
{
    public function isAjaxRequest()
    {
        if (request()->ajax()) {
            return true;
        }
        abort(404);
    }
}
