<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class IsUserMemberOfCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return bool
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if( Auth::hasUser() and Str::lower(Auth::user()->user_type->name != 'admin') and $request->route('company') ){
            $isMemberOfCompany = false;

            Auth::user()->companies()->get()->map(function ($company) use($request, &$isMemberOfCompany){
                $currentCompanyName = $request->route('company');
                if( Str::lower($company->name) == $currentCompanyName )
                    $isMemberOfCompany = true;
            });

            if( !$isMemberOfCompany )
                abort(404);
        }

        return $response;
    }
}
