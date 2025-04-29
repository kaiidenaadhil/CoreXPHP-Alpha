<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService {
    private string $secretKey;

    public function __construct() {
        $this->secretKey = 'v3ry$3cur3_K3y!T0Pr0tectJWT@12345';
    }

    public function generateToken(array $payload, int $expiration = 3600): string {
        $payload['iat'] = time(); // Issued at
        $payload['exp'] = time() + $expiration; // Expiry time
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function verifyToken(string $token): object {
        try {
            return JWT::decode($token, new Key($this->secretKey, 'HS256'));
        } catch (\Exception $e) {
            throw new \Exception("Invalid or expired token");
        }
    }
}
