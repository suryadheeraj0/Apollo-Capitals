<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .header h1 {
            font-size: 24px;
            color: #333333;
        }
        .content {
            padding: 20px 0;
            text-align: left;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }
        .content p strong {
            color: #333333;
        }
        .content a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .content a:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Apollo Capitals</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $name }}</strong>,</p>
            <p>We are thrilled to have you on board! As a part of our family, you'll be working with some of the most talented and innovative minds in the industry. To get started, we’ve created an account for you with the following details:</p>
            <p><strong>Dummy Password:</strong> {{ $dummyPassword }}</p>
            <p>For security reasons, please change your password as soon as you log in.</p>
            <p>To activate your account, please click the button below:</p>
            <a href="{{ route('accountActivation') }}">Activate Your Account</a>
            <p>We are looking forward to seeing the amazing things you will achieve with us. If you have any questions, feel free to reach out at any time.</p>
            <p>Best regards,<br>Apollo Capitals Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Apollo Capitals. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
