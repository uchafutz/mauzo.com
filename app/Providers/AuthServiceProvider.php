<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Purchase\Purchase;
use App\Models\User;
use App\Policies\InventoryCategoryPolicy;
use App\Policies\PurchasePolicy;
use App\Policies\UserPolicy;
use App\Policies\InventoryWarehousePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Purchase::class => PurchasePolicy::class,
        InventoryWarehouse::class => InventoryWarehousePolicy::class,
        InventoryCategory::class => InventoryCategoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
