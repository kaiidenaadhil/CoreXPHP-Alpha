<?php

class AuthModel extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Create a new user in the database.
     */
    public function createUser(array $userData)
    {
        $userAltName = generateUniqueId();
        $stmt = $this->db->prepare("
            INSERT INTO users (userAltName, userEmail, passwordHash, createdAt, updatedAt)
            VALUES (:userAltName,:userEmail, :passwordHash, NOW(), NOW())
        ");
        $stmt->execute([
            ':userAltName' => $userAltName,
            ':userEmail' => $userData['userEmail'],
            ':passwordHash' => $userData['passwordHash']
        ]);
        return $this->db->lastInsertId();
    }

    /**
     * Get a user by email.
     */
    public function getUserByEmail(string $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE userEmail = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Update the password reset token for a user.
     */
    public function updatePasswordResetToken(int $userId, string $token)
    {
        $stmt = $this->db->prepare("UPDATE users SET passwordResetToken = :token WHERE userId = :userId");
        $stmt->execute([
            ':token' => $token,
            ':userId' => $userId
        ]);
    }

    /**
     * Validate the password reset token and return the user ID.
     */
    public function validatePasswordResetToken(string $token)
    {
        $stmt = $this->db->prepare("SELECT userId FROM users WHERE passwordResetToken = :token");
        $stmt->execute([':token' => $token]);
        $result = $stmt->fetch();
        return $result ? $result['userId'] : false;
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(int $userId, string $newPassword)
    {
        $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("
            UPDATE users 
            SET passwordHash = :passwordHash
            WHERE userId = :userId
        ");
        $stmt->execute([
            ':passwordHash' => $passwordHash,
            ':userId' => $userId
        ]);
    }

    /**
     * Log out the user by destroying the session.
     */
    public function logout()
    {
        session_destroy();
    }


    /**
     * Update the user's last login timestamp.
     */
    public function updateLastLogin(int $userId)
    {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET lastLoginAt = NOW() 
            WHERE userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);
    }
}