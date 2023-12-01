<?php

namespace App\Providers;

use App\Models\Group;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        Paginator::defaultView('vendor.pagination.paginator');
        $this->passAllCompaniesTpBladesIfExists();
        $this->passAllMenusToBladesIfExists();
    }

    public function passAllCompaniesTpBladesIfExists()
    {
        View::composer('*', function ($view){
            if( Auth::hasUser() ) {
                $companies = Auth::user()->companies()->get();
                addExcerptToCompanies($companies);
                $view->with(compact('companies'));
            }
        });
    }

    public function passAllMenusToBladesIfExists()
    {
        View::composer('*', function ($view){
            if( Auth::hasUser() ) {
                $groups = Group::all()->load('menus');
                $view->with(compact('groups'));
            }
        });
    }
}
