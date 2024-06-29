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
                                </td>
                            </tr>
                            <tr>
                                <td class="content">
                                    <h2>Customer Inquiry</h2>
                                    <p><strong>Email:</strong> {{ $customerMessage->email }}</p>
                                    <p><strong>Phone:</strong> {{ $customerMessage->phone }}</p>
                                    <p><strong>Message:</strong> {{ $customerMessage->message }}</p>
                                </td>
                            </tr>
                            @php $p = App\Helpers\AppHelper::propertyDetail($customerMessage->property_id) @endphp
                            <tr>
                                <td class="content">
                                    <h2>Property Details</h2>
                                    <p><strong>Title:</strong> {{ $p->title }}</p>
                                    <p><strong>Type:</strong> {{$p->propertyType->name}}</p>
                                    <p><strong>Address:</strong> {{ $p->address }}</p>
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
