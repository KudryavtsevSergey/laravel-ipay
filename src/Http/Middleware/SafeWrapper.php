<?php

namespace Sun\IPay\Http\Middleware;

use Closure;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Sun\IPay\Exceptions\InternalIPayError;
use Throwable;

class SafeWrapper
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws InternalIPayError
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $exception) {
            if ($exception instanceof Responsable) {
                return $exception;
            }
            throw new InternalIPayError($exception);
        }
    }
}
