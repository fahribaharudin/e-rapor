<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;

class Administrator
{

    /**
     * Laravel Authentication Service
     * 
     * @var Illuminate\Auth\Guard
     */
    protected $auth;


    /**
     * Class Constructor!
     * 
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        if ( ! $this->auth->user()->hasRole('Administrator')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
