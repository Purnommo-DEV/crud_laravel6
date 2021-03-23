<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles) 
    // ...$roles artinya dapat memiliki banyak Role (halaman yang diperbolejkan akses sprt admin, siswa pada web.blade)
    {
        //Jika inputan/request user sama atau dengan role,
        //in_array -> helper dari Laravel
        if(in_array($request->user()->role,$roles)){
            //Maka lanjutkan ke halaman yang d tuju
            return $next($request);
        }
        //Jika tidak sama maka akan diarahkan ke Dashboard
        return redirect('/');

        //Selanjutkan middleware akan kita registrasikan ke KERNEL.PHP
    }
}
