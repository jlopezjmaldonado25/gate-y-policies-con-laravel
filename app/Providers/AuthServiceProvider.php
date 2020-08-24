<?php

namespace App\Providers;

use App\{Post, User};
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        // Así como Laravel nos permite definir varias rutas de una sola vez con los controladores de tipo recurso o Resource,
        // también podemos definir varios permisos con una sola línea si utilizamos Gate::resource
        Gate::resource('post', PostPolicy::class); // view, create, update, delete

        // También podemos definir los métodos que queremos enlazar de manera personalizada:
        //Gate::resource('post', PostPolicy::class, [
            //'update' => 'updatePost',
            //'delete' => 'deletePost',
        //]);

        //Gate::define('update-post', 'App\Policies\PostPolicy@update');
        //Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
    }
}
