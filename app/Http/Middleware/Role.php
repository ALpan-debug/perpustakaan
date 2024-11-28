<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        $allow = array_slice(func_get_args(), 2);
        //$allow = ['admin'];

        if(\Auth::user()){ //jika user login
            $ada = \Auth::user()->hasRole()->value('role'); //cek role user login
            if($ada){
                $role =$ada;
            }else{
                $role= 'user';
            }
            //$role ='admin';
            foreach($allow as $allow){ //untuk setiap role yang boleh
               if($role == $allow){ //jika role yang boleh sama dengan role user
                    return $next($request); // Lanjut ke perintah selanjutnya
                }
            }
            return redirect('/dashboard');
        }else{
            return redirect('.'); //jika belum login, arahkan ke halaman login
        }

        // return $next($request);
    }
}
