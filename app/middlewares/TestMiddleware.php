<?php

class TestMiddleware {
    public function handle($request, $next) {
        echo "Test Middleware is working fine;";

        // Call the next middleware or route handler
        return $next($request);
    }
}
