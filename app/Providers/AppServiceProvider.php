<?php

// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Vehiculo;
use App\Policies\VehiculoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vehiculo::class => VehiculoPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
