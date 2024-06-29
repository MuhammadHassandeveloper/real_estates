<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #00ba74;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .content h2 {
            color: #00ba74;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button {
            background-color: #00ba74;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
        }
        .logo {
            max-width: 150px;
            margin: 0 auto 20px;
        }

        .ii a[href] {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<table width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="center">
            <table class="email-container" width="600" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td class="header">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">
                                    <h1>{{ App\Helpers\AppHelper::site_name() }}</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="content">
                                    <h2>Welcome, {{ $user->first_name }}!</h2>
                                    <p>Thank you for registering with us. We're excited to have you on board.</p>
                                    <p>If you have any questions, feel free to reach out to our support team.</p>
                                    <div class="button-container">
                                        <a style="color: white;" href="{{ url('/login') }}" class="button">Login to Your Account</a>
                                    </div>
                                    <p>Best Regards,<br>{{ App\Helpers\AppHelper::site_name() }} Team</p>
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
        </td>
    </tr>
</table>
</body>
</html>
