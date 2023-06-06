<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\ListItem;
use App\Models\ListUnit;
use App\Policies\ListItemPolicy;
use App\Policies\ListUnitPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ListUnit::class => ListUnitPolicy::class,
        ListItem::class => ListItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
