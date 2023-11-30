<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Http\Request;
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
}
