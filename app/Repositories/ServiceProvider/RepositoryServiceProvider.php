<?php

namespace App\Repositories\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\PostCategoryRepositoryInterface',
            'App\Repositories\PostCategoryRepository'
        );


        $this->app->bind(
            'App\Repositories\Interfaces\PostRepositoryInterface',
            'App\Repositories\PostRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\PostCommentRepositoryInterface',
            'App\Repositories\PostCommentRepository'
        );


    }
}
