<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .content h1 {
            color: #00ba74;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #00ba74;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
        }
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px solid #dddddd;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }

        .ii a[href] {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <img src="{{ asset('assets/img/logo.png') }}" alt="App Logo">
    </div>
    <div class="content">
        <h1>Hello, {{ $name }}</h1>
        <p>You requested a password reset. Click the button below to reset your password:</p>
        <p style="text-align: center;">
            <a href="{{ $link }}" class="button">Reset Password</a>
        </p>
        <table>
            <tr>
                <th>Username</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>Request Time</th>
                <td>{{ $request_time }}</td>
            </tr>
        </table>
        <p>If you did not request a password reset, please ignore this email.</p>
    </div>
    <div class="footer">
        <p>Thank you for using {{ config('app.name') }}!</p>
    </div>
</div>
</body>
</html>
