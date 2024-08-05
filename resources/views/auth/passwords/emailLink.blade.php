<!-- resources/views/auth/passwords/email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>Click the link below to reset your password:</p>
    <p><a href="{{ $resetUrl }}">Reset Password</a></p>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>
