<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            $users = [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'gender' => 'Male'
                ],
                [
                    'id' => 2,
                    'name' => 'Jane Doe',
                    'gender' => 'Female'
                ]
            ];
            return new UserService($users);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}