<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Traits\AjaxableTrait;
use Conner\Tagging\Model\Tag;

class TagController extends Controller
{
    use AjaxableTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($this->isAjaxRequest()) {
            $tags = Tag::get()->pluck('slug')->toArray();
            return $tags;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListItem $listItem)
    {
        $this->authorize('update', $listItem->listUnit, [$listItem]);
        if ($this->isAjaxRequest()) {
            $tags = request()->tags;
            $listItem->retag($tags);
        }
    }
}
