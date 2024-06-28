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
        table {
            border-spacing: 0;
            width: 100%;
        }
        table td {
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
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
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #00ba74;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
            font-size: 14px;
            border-top: 1px solid #dddddd;
        }
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100%;
                padding: 10px;
            }
            .content h1 {
                font-size: 20px;
            }
            .content p {
                font-size: 14px;
            }
            .button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
        .ii a[href] {
            color: #ffffff !important;
        }
        a {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<table role="presentation" class="email-container" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table role="presentation" width="100%">
                <tr>
                    <td class="header">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="App Logo">
                    </td>
                </tr>
                <tr>
                    <td class="content">
                        <h1>Hello, {{ $name }}</h1>
                        <p>You recently requested to reset your password for your {{ config('app.name') }} account. Click the button below to reset it:</p>
                        <p style="text-align: center;">
                            <a style="color: white;" href="{{ $link }}" class="button">Reset Password</a>
                        </p>
                        <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        <p>Thank you for using {{ config('app.name') }}. If you have any questions, please contact our support team.</p>
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
