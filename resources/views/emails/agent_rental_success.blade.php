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
                <h1>New Property Rental Notification</h1>
                <h2>Property Details</h2>
                <table>
                    <tr>
                        <th>Title</th>
                        <td>{{ $propertyRental->property->title }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $propertyRental->property->address }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $propertyRental->property->city->name }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $propertyRental->property->state->name }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>${{ $propertyRental->rental_price }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ $propertyRental->start_date }}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{ $propertyRental->end_date }}</td>
                    </tr>
                    <tr>
                        <th>Note</th>
                        <td>{{ $propertyRental->note }}</td>
                    </tr>
                </table>
                <h2>Customer Details</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <td style="color: #333333;">{{ $propertyRental->customer->first_name }} {{ $propertyRental->customer->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td style="color: #000000;">{{ $propertyRental->customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td style="color: #333333;">{{ $propertyRental->customer->phone }}</td>
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
