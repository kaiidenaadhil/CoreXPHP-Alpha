<?php

class AuthMiddleware implements MiddlewareInterface
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['userAltName'])) {
            header('Location:'.ROOT.'/login');
            exit();
        }
        return $next($request);
    }
}

