<?php

// Authentication Routes

$app->router->get('/login', [AuthController::class, 'login']); // Show login page
$app->router->post('/login', [AuthController::class, 'handleLogin']); // Handle login request

$app->router->get('/register', [AuthController::class, 'register']); // Show registration page
$app->router->post('/register', [AuthController::class, 'initRegister']); // Handle user registration

$app->router->get('/activate/{token}', [AuthController::class, 'activateAccount']); // Account activation with token

// Password Reset Routes
$app->router->get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm']); // Show reset password form
$app->router->post('/reset-password/{token}', [AuthController::class, 'resetPassword']); // Handle password reset

$app->router->get('/forget-password', [AuthController::class, 'forget']); // Show forgot password page
$app->router->post('/forget-password', [AuthController::class, 'forgetPassword']); // Handle forgot password request

// Logout and Admin Dashboard
$app->router->get('/logout', [AuthController::class, 'logout']); // Handle logout
$app->router->get('/admin', [AuthController::class, 'dashboard']); // Admin dashboard (requires authentication)