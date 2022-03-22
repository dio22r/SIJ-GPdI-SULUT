<?php

namespace App\Providers;

use App\Models\MhJemaat;
use App\Models\MhKelompok;
use App\Models\MhKeluarga;
use App\Policies\JemaatPolicy;
use App\Policies\KelompokPolicy;
use App\Policies\KeluargaPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        MhJemaat::class => JemaatPolicy::class,
        User::class => UserPolicy::class,
        MhKelompok::class => KelompokPolicy::class,
        MhKeluarga::class => KeluargaPolicy::class
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
