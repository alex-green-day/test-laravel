<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use phpDocumentor\Reflection\Types\True_;

class XAuth extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if ($request->hasHeader('X-AUTH-TOKEN')) {
            $users = User::all();
            $incomingToken = $request->header('X-AUTH-TOKEN');
            foreach ($users as $user) {
                if ($user->api_token == $incomingToken) {
                    return true;
                }
            }
        }

        $this->unauthenticated($request, $guards);

        return false;
    }
}
