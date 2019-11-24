<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin {

    public function handle($request, Closure $next) {
        if(session()->has('user')) {
            $user = session()->get('user')[0];

            if($user->role == 'administrator') {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {

            return redirect('/');
        }
    }
}