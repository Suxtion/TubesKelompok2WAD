<?php

namespace App\Providers;

use App\Models\CateringOrder;
use App\Policies\CateringOrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        CateringOrder::class => CateringOrderPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Define admin role
        Gate::define('admin', function ($user) {
            return $user->is_admin; // Asumsikan ada kolom is_admin di tabel users
        });
    }
}