<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer('layouts.sidebar', function ($view) {
            if (Cache::has('cats')) {
                $cats = Cache::get('cats');
            } else {
                $cats = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('cats', $cats, 30);
            }

            $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(3)->get());
            $view->with('cats', $cats);
        });
        View::composer('admin.layouts.layout', function ($view) {
            $user = User::query()->firstWhere('is_admin', '=', 1);
            $view->with('user', $user);
        });
        View::composer('layouts.navbar', function ($view) {
            $all_categories = Category::query()->orderBy('id', 'desc')->get();
            $view->with('all_categories', $all_categories);
        });
        View::composer('layouts.footer', function ($view) {
            $all_posts = Post::query()->orderBy('views', 'desc')->limit(3)->get();
            $all_categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
            $view->with('all_posts', $all_posts);
            $view->with('all_categories', $all_categories);
        });

    }

}
