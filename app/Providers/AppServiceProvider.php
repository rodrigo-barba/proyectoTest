<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /** Bootstrap any application services. */
    public function boot(): void
    {
        //$user corresponde al usuario logueado 
        // Gate::define('update-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });
    }
}
