<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use URL;
use Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (isset(Auth::user()->user_role)) {
            $role = Role::select('name')->where(['id' => Auth::user()->user_role])->first();
            
            if ($role) {
                Session::put('role', $role['name']);
                switch ($role['name']) {

                    case 'admin':

                        return $next($request);
                        break;
                    case 'user':
                        
                        $url = "information/" . Auth::user()->id;
                        break;

                    default:
                        $url = 'test';
                        break;
                }

                return redirect($url);
            }
        }
        return $next($request);
    }
}