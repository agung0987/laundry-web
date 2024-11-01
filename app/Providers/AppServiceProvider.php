<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Panel;
use SolutionForest\FilamentAccessManagement\Pages\Menu;
use SolutionForest\FilamentAccessManagement\Resources\UserResource;
use SolutionForest\FilamentAccessManagement\Resources\RoleResource;
use SolutionForest\FilamentAccessManagement\Resources\PermissionResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Panel::registerToCluster(Menu::class, [
        //     'canCreateAnother' => false,
        // ]);

        // Panel::registerToCluster(UserResource::class, [
        //     'canCreateAnother' => false,
        // ]);

        // Panel::registerToCluster(RoleResource::class, [
        //     'canCreateAnother' => false,
        // ]);

        // Panel::registerToCluster(PermissionResource::class, [
        //     'canCreateAnother' => false,
        // ]);
    }
}
