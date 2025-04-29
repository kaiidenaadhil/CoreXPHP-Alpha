<?php

class JWTController extends Controller
{
    public function one()
    {
        $jwtService = App::$service->get('jwt'); // Access the JWTService

// Define payload data
        $payload = [
            'user_id' => 1,
            'email' => 'kaiidenaadhil@gmail.com',
        ];

// Generate token
        $token = $jwtService->generateToken($payload, 3600); // Token valid for 1 hour
        echo "Generated Token: " . $token;

        $decodedToken = $jwtService->verifyToken($token); // Pass the token to verify
        // print_r($decodedToken); // Display decoded token payload
         echo "User ID: " . $decodedToken->user_id . "\n";
         echo "Email: " . $decodedToken->email . "\n";
         echo "Issued At: " . date('Y-m-d H:i:s', $decodedToken->iat) . "\n";
         echo "Expires At: " . date('Y-m-d H:i:s', $decodedToken->exp) . "\n";

    }

    public function two()
    {
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJlbWFpbCI6ImthaWlkZW5hYWRoaWxAZ21haWwuY29tIiwiaWF0IjoxNzQyNjMzNDA1LCJleHAiOjE3NDI2MzcwMDV9.KTactz3nYWvkF4GxVygwyVjGsTDdv8riQlulvY6h5x8";
        $jwtService = App::$service->get('jwt'); // Access the JWTService

        try {
            // Verify token
            $decodedToken = $jwtService->verifyToken($token); // Pass the token to verify
           // print_r($decodedToken); // Display decoded token payload
            echo "User ID: " . $decodedToken->user_id . "\n";
            echo "Email: " . $decodedToken->email . "\n";
            echo "Issued At: " . date('Y-m-d H:i:s', $decodedToken->iat) . "\n";
            echo "Expires At: " . date('Y-m-d H:i:s', $decodedToken->exp) . "\n";
        } catch (Exception $e) {
            echo "JWT Error: " . $e->getMessage();
        }

    }
}
