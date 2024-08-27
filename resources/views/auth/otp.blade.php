<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 1rem;
            color: #333;
            font-weight: 500;
        }
        .message {
            margin-bottom: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            margin-top: 0.5rem;
        }
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }
        button:hover {
            background-color: #2980b9;
        }
        .secondary-btn {
            background-color: #95a5a6;
        }
        .secondary-btn:hover {
            background-color: #7f8c8d;
        }
        .note {
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #999;
        }
        .icon {
            color: #e74c3c;
            margin-right: 0.3rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verify 2FA</h1>

        <!-- Display Error Messages -->
        @if ($errors->has('otp'))
            <div class="error">
                <i class="fas fa-exclamation-triangle icon"></i> {{ $errors->first('otp') }}
            </div>
        @endif

        <p class="message">
            If your OTP has expired or you haven't received it, you can request a new OTP. The OTP is valid for only 1 minute.
        </p>

        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="otp">Enter OTP</label>
                <input type="text" id="otp" name="otp" placeholder="123456" required>
            </div>
            <button type="submit">Verify OTP</button>
        </form>

        <form id="request-otp-form" action="{{ route('otp.request') }}" method="POST">
            @csrf
            <button type="submit" class="secondary-btn" onclick="requestNewOtp()">Request New OTP</button>
        </form>
    </div>

    <script>
        function requestNewOtp() {
           alert('New OTP Has Sent To Your Registerd Mail')
        }
    </script>
</body>
</html>
