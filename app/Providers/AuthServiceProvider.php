<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Modelo;
use App\Policies\ModeloPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O array de mapeamentos de políticas.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Modelo::class => ModeloPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

