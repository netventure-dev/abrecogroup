<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatus
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
        $user = auth('api')->user();
        if ($user) {
            if (!$user->status) {
                $user->token()->revoke();
                $data = (object) [];
                return response()->json(['code' => 401, 'message' => 'Session Expired.', 'data' => $data], 200);
            }
        }
        return $next($request);
    }
}
