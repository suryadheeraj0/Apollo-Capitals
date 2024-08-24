<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Apollo Capital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 20px 0;
        }
        .content .credentials {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            font-size: 16px;
        }
        .credentials p {
            margin: 5px 0;
        }
        .content .button {
            text-align: center;
            margin: 20px 0;
        }
        .content .button a {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Apollo Capitals</h1>
        </div>
        <div class="content">
            <p>Hello {{ $name }},</p>
            <p>Your account has been successfully created. Here are your login details:</p>
            <div class="credentials">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Password:</strong> {{ $dummyPassword }}</p>
            </div>
            <p>To get started, please click the button below to log in to your account:</p>
            <div class="button">
                <a href="http://127.0.0.1:8000/login">Log in to Your Account</a>
            </div>
            <p><strong>Important:</strong> For your security, please change your password after logging in. You can do this in the Profile section of your account.</p>
            <p>If you did not request this account or have any concerns, please contact our support team.</p>
            <p>Best Regards,<br>Apollo Capitals Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Apollo Capitals. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
