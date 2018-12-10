<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;
use App\Category;
use App\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        Schema::defaultStringLength(191);
        view()->composer('pages._sidebar', function($view){
            $view->with('popularPosts', Post::orderBy('views', 'desc')->take(3)->get())
                 ->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get())
                 ->with('recentPosts', Post::orderBy('date', 'desc')->take(4)->get())
                 ->with('categories', Category::all());
        });
        view()->composer('admin._sidebar', function($view){
            $view->with('comments_count', Comment::where('status', 0)->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
