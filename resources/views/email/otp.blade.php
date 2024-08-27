<!DOCTYPE html>
<html>
<head>
    <title>Your OTP for Two-Factor Authentication</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #4a90e2;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }

        .content {
            padding: 30px;
            text-align: center;
            color: #333333;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #4a90e2;
            margin: 20px 0;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background-color: #f4f4f4;
            font-size: 12px;
            color: #888888;
        }

        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Apollo Capitals</h1>
        </div>

        <div class="content">
            <p>Hello, {{ $user->name }}!</p>
            <p>We have received a request to log in to your Apollo Capitals account using two-factor authentication (2FA).</p>
            <p>Your OTP (One-Time Password) for completing the login process is:</p>
            <p class="otp-code">{{ $otp }}</p>
            <p>Please enter this code in the app to proceed. The OTP is valid for only 1 minute.</p>
            <p>If you did not request this, please ignore this email or contact support immediately.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Apollo Capitals. All rights reserved.</p>
            <p><a href="#">Unsubscribe</a> | <a href="#">Contact Support</a></p>
        </div>
    </div>
</body>
</html>
