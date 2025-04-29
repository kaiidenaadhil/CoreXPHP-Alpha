<?php
class CSRF {
    public static function generate() {
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }

    public static function validate($token) {
        // Skip validation if no token exists in session (development flexibility)
        if (!isset($_SESSION['_csrf_token'])) {
            return false;
        }
        
        if ($_SESSION['_csrf_token'] !== $token) {
            throw new Exception('Invalid or missing CSRF token.');
        }

        // Optional: Regenerate token after successful validation to prevent reuse
        unset($_SESSION['_csrf_token']);
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        return true;
    }

    public static function handle($request, $response) {
        if (in_array($request->method(), ['post', 'put', 'delete'])) {
            $token = $request->getBody()['_csrf_token'] ?? null;

            if ($token === null) {
                // Skip validation if no token provided
                return;
            }

            try {
                if (self::validate($token)) {
                   // echo "CSRF token validated.";
                }
            } catch (Exception $e) {
                http_response_code(403);
                echo 'CSRF validation failed: ' . $e->getMessage();
                exit;
            }
        }
    }
}
