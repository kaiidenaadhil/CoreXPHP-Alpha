<?php

class AuthController extends Controller
{

    public function __construct()
    {

        // Check if session variables are not set
        if (!isset($_SESSION['userId']) && isset($_COOKIE['userId'])) {
            // If cookies are set, use them to restore the session
            $_SESSION['userId'] = $_COOKIE['userId'];
            $_SESSION['userAltName'] = $_COOKIE['userAltName'];
            $_SESSION['userRole'] = $_COOKIE['userRole'];
        }
    }
    /**
     * Show the registration page.
     */
    public function register(Request $request, Response $response)
    {
        // Render the registration view
        return $this->onlyView('auth/register');
    }

    /**
     * Handle user registration.
     */
    public function initRegister(Request $request, Response $response)
    {
        $authModel = $this->model('AuthModel'); // Load the AuthModel
        $data = $request->getBody();

        if (isset($data['userEmail']) && isset($data['userPassword'])) {
            // Hash the password
            $passwordHash = password_hash($data['userPassword'], PASSWORD_BCRYPT);

            // Generate the JWT token with user details
            $jwtService = App::$service->get('jwt');
            $token = $jwtService->generateToken([
                'userEmail' => $data['userEmail'],
                'passwordHash' => $passwordHash
            ], 86400); // Token valid for 24 hours

            // Send confirmation email
            $this->sendConfirmationEmail($data['userEmail'], $token);

            return $response->json([
                'message' => 'Confirmation email sent successfully.',
                'email' => $data['userEmail'],
                'token' => $token
            ]);
        }

        return $response->json(['error' => 'Name, email, and password are required.'], 400);
    }

    /**
     * Send a confirmation email.
     */

    private function sendConfirmationEmail(string $email, string $token)
    {
        $registrationLink = ROOT . "/activate/" . $token;

        $mailService = App::$service->get('mail');
        $mailService->send([
            'to' => $email,
            'subject' => 'Complete Your Registration',
            'template' => 'registration',
            'templateParams' => [
                'link' => $registrationLink
            ],
        ]);
    }

    /**
     * Activate the user account and insert user details into the database.
     */
    public function activateAccount(Request $request, $token)
    {

        $jwtService = App::$service->get('jwt');
        $decodedToken = $jwtService->verifyToken($token); // Verify the token



        if ($decodedToken &&  isset($decodedToken->userEmail) && isset($decodedToken->passwordHash)) {
            $authModel = $this->model('AuthModel');

            // Check if the user already exists
            if ($authModel->getUserByEmail($decodedToken->userEmail)) {
                return "User already exists.";
            }

            // Insert user into the database
            $userId = $authModel->createUser([
                'userEmail' => $decodedToken->userEmail,
                'passwordHash' => $decodedToken->passwordHash
            ]);

            if ($userId) {
                return "Account activated successfully. You can now log in.";
            } else {
                return "Failed to activate account. Please try again.";
            }
        } else {
            return "Invalid or expired token.";
        }
    }




    /**
     * Show the login page (GET request).
     */
    public function login(Request $request, Response $response)
    {
        // Render the login view
        return $this->onlyView('auth/login');
    }

    /**
     * Handle login submission (POST request).
     */
    public function handleLogin(Request $request, Response $response)
    {
        $data = $request->getBody();
        $authModel = $this->model('AuthModel');

        // Validate required fields
        if (empty($data['userEmail']) || empty($data['userPassword'])) {
            $_SESSION['error'] = 'Email and password are required.';
            echo $_SESSION['error'];
            exit;
        }

        // Retrieve user by email
        $user = $authModel->getUserByEmail($data['userEmail']);

        // Check if user exists and password is correct
        if (!$user || !password_verify($data['userPassword'], $user['passwordHash'])) {
            $_SESSION['error'] = 'Invalid email or password.';
            echo $_SESSION['error'];
            exit;
        }

        // Update last login timestamp
        $authModel->updateLastLogin($user['userId']);

        // Set session variables
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['userAltName'] = $user['userAltName'];
        $_SESSION['userRole'] = $user['userRole'];

        // Set cookies for 30 days (if "Remember Me" is checked)
        if (!empty($data['rememberMe'])) {
            $cookieExpiration = time() + (30 * 24 * 60 * 60); // 30 days

            setcookie('userId', $user['userId'], $cookieExpiration, '/');
            setcookie('userAltName', $user['userAltName'], $cookieExpiration, '/');
            setcookie('userRole', $user['userRole'], $cookieExpiration, '/');
        }

        // Redirect to admin dashboard
        header('Location: ' . ROOT . '/admin');
        exit;
    }


    // ... Rest of existing methods ...
    /**
     * Handle user logout.
     */
    public function logout()
    {
        $authModel = $this->model('AuthModel');
        $authModel->logout();

        // Start the session to modify it
        session_start();

        // Unset specific session variables
        unset($_SESSION['userId'], $_SESSION['userAltName'], $_SESSION['userRole']);

        // Destroy the entire session
        $_SESSION = [];
        session_destroy();

        // Destroy user-related cookies
        if (isset($_COOKIE['userId'])) {
            setcookie('userId', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['userAltName'])) {
            setcookie('userAltName', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['userType'])) {
            setcookie('userType', '', time() - 3600, '/');
        }

        // Redirect to homepage or login page
        header('Location: ' . ROOT);
        exit;
    }



    // Show forgot password page (GET request)
    public function forget(Request $request, Response $response)
    {
        // Render the forgot password view
        return $this->onlyView('auth/forget-password');
    }

    /**
     * Handle the forgot password request.
     */
    public function forgetPassword(Request $request, Response $response)
    {
        $data = $request->getBody();
        $authModel = $this->model('AuthModel');

        if (empty($data['userEmail'])) {
            return $response->json(['error' => 'Email is required.'], 400);
        }

        $userData = $authModel->getUserByEmail($data['userEmail']);
        if ($userData) {
            // Generate JWT instead of uniqid()
            $jwtService = App::$service->get('jwt');
            $resetToken = $jwtService->generateToken(['userId' => $userData['userId']], 3600); // 1-hour expiry

            $resetLink = ROOT . "/reset-password/" . $resetToken;

            // Send email with the JWT reset token
            $mailService = App::$service->get('mail');
            $mailService->send([
                'to' => $data['userEmail'],
                'subject' => 'Password Reset Request',
                'template' => 'reset-password',
                'templateParams' => ['link' => $resetLink],
            ]);

            return $response->json(['message' => 'Password reset email sent.']);
        }

        return $response->json(['error' => 'No user found with this email.'], 404);
    }



    /**
     * Handle the reset password request.
     */
    public function resetPasswordForm($token)
    {
        $params['token'] = $token;
        return $this->view('auth/reset-password', $params);
    }


    public function resetPassword(Request $request, $token)
    {

        $data = $request->getBody();

        $jwtService = App::$service->get('jwt');
        $token = str_replace("reset-", "", $token);
        $decodedToken = $jwtService->verifyToken($token);

        if (!$decodedToken || !isset($decodedToken->userId)) {
            return "Invalid or expired token.";
        }

        if (!isset($data['newPassword']) || $data['newPassword'] !== $data['confirmPassword']) {
            return "Passwords do not match.";
        }

        $authModel = $this->model('AuthModel');
        $authModel->updatePassword($decodedToken->userId, password_hash($data['newPassword'], PASSWORD_BCRYPT));
        return "Password updated successfully.";
    }

    public function dashboard()
    {
        if (isset($_SESSION['userAltName'])) {

            return $this->adminView('auth/dashboard', $params = []); // Success Page
        } else {
            header("Location: " . ROOT);
            exit();
        }
    }
}
