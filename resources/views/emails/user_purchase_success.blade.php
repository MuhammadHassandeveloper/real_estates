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
            border-radius: 8px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
            border-top: 1px solid #dddddd;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button {
            background-color: #EC3323;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .content h2 {
            color: #EC3323;
            margin-top: 20px;
        }
        .content table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .content table th, .content table td {
            padding: 10px;
            border: 1px solid #dddddd;
        }
        .ii a[href] {
            color: #000000 !important;
        }
        a {
            color: #000000 !important;
        }
    </style>
</head>
<body>
@php
    use App\Helpers\AppHelper;
@endphp
<div class="email-container">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="header">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </td>
        </tr>
        <tr>
            <td class="content">
                <h1>Property Purchase Success</h1>
                <h2>Property Details</h2>
                <table>
                    <tr>
                        <th>Title</th>
                        <td>{{ $propertyPurchase->property->title }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $propertyPurchase->property->address }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $propertyPurchase->property->city->name }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $propertyPurchase->property->state->name }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>${{ $propertyPurchase->purchased_price }}</td>
                    </tr>
                </table>
                <div class="button-container">
                    <a style="color: white;" href="{{ url('/login') }}" class="button">Login</a>
                </div>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>Thank you for using {{ AppHelper::site_name() }}. If you have any questions, please contact our support team.</p>
                <p>&copy; {{ date('Y') }} {{ AppHelper::site_name() }}. All rights reserved.</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
