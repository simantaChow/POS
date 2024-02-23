<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifycationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTToken::VerifyToken($token);
        if ($result == "unauthorized") {
            return redirect('/login');

        } else {
            $request->headers->set('email', $result->userEmail);
            $request->headers->set('userID', $result->userID);
            return $next($request);
        }
    }
}
