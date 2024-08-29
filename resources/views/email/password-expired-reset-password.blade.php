<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #003366;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #003366;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Apollo Capitals</h1>
        </div>
        <div class="content">
            <h2>Hello {{$name}},</h2>
            <p>We noticed that you haven't updated your password in the last 30 days. For your security, we recommend updating your password regularly to keep your account secure.</p>
            <p>Please reset your password by clicking the link below:</p>
            <a href="{{ route('password.request') }}" class="button">Reset Password</a>
            <p>If you did not request this change, please ignore this email.</p>
            <p>Thank you for being a part of Apollo Capitals. We are committed to keeping your account secure.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Apollo Capitals. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
