<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //更改分页模版样式
        //运行  php artisan vendor:publish --tag=laravel-pagination 将文件copy到 resources/vendor下面
        Paginator::defaultView('vendor.pagination.semantic-ui');

        \App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);


    }
}
