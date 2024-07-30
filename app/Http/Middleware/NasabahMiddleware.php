<?php

namespace App\Http\Middleware;

use App\Models\Nasabah;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NasabahMiddleware
{

    public function handle(Request $request, Closure $next, $role): Response
    {
        
        if (Auth::user()->role === $role) {

            if(Nasabah::where('user_id', Auth::user()->id)->exists()){
                return $next($request);
            }

            return to_route('form-nasabah', ['id' => Auth::user()->id]);


        }
        return abort(403, "Kamu Tidak memiliki Akses!");
    }
}
