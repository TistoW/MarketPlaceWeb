<?php

namespace App\Http\Middleware;

use App\Http\Helper;
use App\Models\PersonalToken;
use Closure;
use Illuminate\Http\Request;

class AuthUser {

    use Helper;

    public function handle(Request $request, Closure $next) {

        $token = $request->header('token');
        $personalToken = PersonalToken::where('token', $token)->first();
        if ($personalToken) {
            return $next($request);
        } else {
            return $this->error("Token Expired");
        }
    }
}
