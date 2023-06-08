<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Models\ListUnit;
use App\Traits\AjaxableTrait;
use Conner\Tagging\Model\Tag;
use App\Http\Requests\ListItemRequest;
use Illuminate\Database\Eloquent\Builder;

class ListItemController extends Controller
{
    use AjaxableTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ListUnit $listUnit)
    {
        $this->authorize('viewAny', [ListItem::class, $listUnit]);
        if (request()->ajax()) {
            $search = request()->search;
            $tags = request()->tags;
            $listItems = $listUnit->items()
                ->when($search, function (Builder $query, string $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->when($tags, function (Builder $query, array $tags) {
                    $query->withAllTags($tags);
                })
                ->get();
            return view('list-items.row', compact('listItems'));
        }
        $tags = Tag::get();
        return view('list-items.index', compact('listUnit', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListItemRequest $request, ListUnit $listUnit)
    {
        $this->authorize('create', [ListItem::class, $listUnit]);
        if ($this->isAjaxRequest()) {
            return $listUnit->items()->create($request->validated());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListItemRequest $request, ListUnit $listUnit, ListItem $listItem)
    {
        $this->authorize('update', $listUnit, [$listItem]);
        if ($this->isAjaxRequest()) {
            return $listItem->update($request->validated());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListUnit $listUnit, ListItem $listItem)
    {
        $this->authorize('delete', $listUnit, [$listItem]);
        if ($this->isAjaxRequest()) {
            return $listItem->delete();
        }
    }
}
