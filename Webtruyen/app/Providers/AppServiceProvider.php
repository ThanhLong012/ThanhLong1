<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Information;





use Auth;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*',function($view) {
            
            $categories = Category::orderBy('name', 'ASC')->get();
            $genres = Genre::orderBy('name', 'ASC')->get();
            $authors = Author::orderBy('name', 'ASC')->get();

            $info = Information::find(1);

            $view->with('categories', $categories )->with('genres', $genres )->with('authors', $authors)->with('info', $info);

        });
    }
}
