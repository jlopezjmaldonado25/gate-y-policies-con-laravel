<?php

namespace App\Providers;

use App\{
    Policies\OldPostPolicy,Post, User
};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        }); */

/*         Gate::define('view-dashboard', function (User $user) {
            return $user->role === 'author';
        }); */

        // Así como Laravel nos permite definir varias rutas de una sola vez con los controladores de tipo recurso o Resource,
        // también podemos definir varios permisos con una sola línea si utilizamos Gate::resource
        //Gate::resource('post', OldPostPolicy::class); // view, create, update, delete

        // También podemos definir los métodos que queremos enlazar de manera personalizada:
        //Gate::resource('post', OldPostPolicy::class, [
            //'update' => 'updatePost',
            //'delete' => 'deletePost',
        //]);

        //Gate::define('update-post', 'App\Policies\OldPostPolicy@update');
        //Gate::define('delete-post', 'App\Policies\OldPostPolicy@delete');

        Gate::define('see-content', function(?User $user){

            dump('see content');

            return $user || Cookie::get('accept_terms') === '1';

        });
    }
}
