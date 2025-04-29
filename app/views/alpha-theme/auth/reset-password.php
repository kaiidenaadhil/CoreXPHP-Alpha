<!-- reset-password.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <form action="<?= ROOT ?>/reset-password/<?=$params['token'] ?>" method="POST">
        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" required>
        <br>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" required>
        <br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
