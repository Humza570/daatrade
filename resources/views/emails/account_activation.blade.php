<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>
    <h1>Account Activation</h1>
    <p>Hello {{ $user->name }},</p>
    <p>Your account has been successfully activated.</p>
    <p>Click the button below to start using your account:</p>
    <a href="{{ $activationLink }}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">Activate Account</a>
</body>
</html>
