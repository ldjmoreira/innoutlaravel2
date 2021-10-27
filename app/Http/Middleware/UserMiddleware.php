<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // registre seu middleware no kernel.php ver o userMiddleware para exemp
    public function handle($request, Closure $next)
    {
        if($request->password != $request->confirm_password){
            flash('Error')->error();
            return view('admin.save.Save_user')->withSuccess('ERROR!');
            // return Redirect::to('form')->withInput(Input::except('password'));
        }else{
            $request->nome = 2;
        return $next($request);
        }
    }
}
