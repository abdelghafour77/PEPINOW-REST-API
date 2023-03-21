<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <p>Hello,</p>

    <p>We received a request to reset the password for your account. If you did not make this request, you can safely ignore this email.</p>

    <p>To reset your password, please click the link below:</p>

    <p><a href="{{ $resetLink }}">Reset Password</a></p>

    <p>If the above link doesn't work, copy and paste the following URL into your browser:</p>

    <p>{{ $resetLink }}</p>

    <p>Thank you,</p>

    <p>The [Your Company] Team</p>
</body>
</html>
