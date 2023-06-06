<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListUnit;
use App\Http\Requests\ListUnitRequest;
use App\Traits\AjaxableTrait;

class ListUnitController extends Controller
{
    use AjaxableTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listUnits = ListUnit::with('sharedWithUsers')->whereBelongsTo(auth()->user())->get();
        $listUnitsSharedWithMe = auth()->user()->sharedListUnitsWithMe()->get();
        return view('list-units.index', compact('listUnits', 'listUnitsSharedWithMe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListUnitRequest $request)
    {
        $this->authorize('create', ListUnit::class);
        if ($this->isAjaxRequest()) {
            return auth()->user()->listUnits()->create($request->validated());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListUnitRequest $request, ListUnit $listUnit)
    {
        $this->authorize('update', $listUnit);
        if ($this->isAjaxRequest()) {
            return $listUnit->update($request->validated());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListUnit $listUnit)
    {
        $this->authorize('delete', $listUnit);
        if ($this->isAjaxRequest()) {
            return $listUnit->delete();
        }
    }

    public function shareListUnitWithUser(ListUnit $listUnit, User $user)
    {
        if ($this->isAjaxRequest()) {
            $listUnit->sharedWithUsers()->attach($user->id, ['shared_by' => auth()->user()->id]);
            return $listUnit->sharedWithUsers()->get(['id', 'name']);
        }
    }
}
