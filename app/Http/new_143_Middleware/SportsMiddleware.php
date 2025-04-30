<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SportsMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth,
                                ResponseFactory $response)
    {

        $this->auth = $auth;
        $this->response = $response;
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
        try {

            $user = Auth::guard('sports')->user();
            if ($user)
            {
                return $next($request);

                // $user = $this->auth->user();
                // $actions = $request->route()->getAction();
                // $roles = isset($actions['roles']) ? $actions['roles'] : null;
                // if($roles && !$user->hasRoles($roles)) {
                //     return $this->response->redirectTo('/admin/unauthorized');
                // }
                // elseif($user->hasRoles(ConstantHelper::ADMIN_ROLES))
                // else
                //     return redirect()->guest('/admin/login');
            }
            else {
                return $this->response->redirectTo(route('sports.login'));
            }
        }
        catch(Exception $e){
            return redirect()->intended('ums-login');
        }
    }
}
