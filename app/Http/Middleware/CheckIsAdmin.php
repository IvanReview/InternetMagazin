<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
        if(!$user->isAdmin()){//метод сидит в модели
            session()->flash('warning', 'У вас нет прав в этой стране');
            return redirect()->route('index');
        };

        return $next($request);
    }
}
