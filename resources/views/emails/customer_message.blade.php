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
                                    <h2>Contact Message From Customer</h2>
                                    <p><strong>Email:</strong> {{ $email }}</p>
                                    <p><strong>Phone:</strong> {{ $phone }}</p>
                                    <p><strong>Message:</strong> {{ $message }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="footer">
                                    <p>Thank you for contacting us!</p>
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
