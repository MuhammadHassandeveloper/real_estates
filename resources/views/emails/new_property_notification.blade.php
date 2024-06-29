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
            background-color: #00ba74;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .content h2 {
            color: #00ba74;
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
            color: #ffffff !important;
        }

         a {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<div class="email-container">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="header">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </td>
        </tr>
        <tr>
            <td class="content">
                <h1>New Property Created</h1>
                <h2>Property Details</h2>
                <table>
                    <tr>
                        <th>Title</th>
                        <td>{{ $property->title }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $property->propertyType->name }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $property->property_category }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $property->price }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $property->address }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $property->city->name }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $property->state->name }}</td>
                    </tr>
                </table>
                <h2>User Details</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $agent->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $agent->phone }}</td>
                    </tr>
                </table>
                <div class="button-container">
                    <a style="color: white;" href="{{ url('/login') }}" class="button">Login to Admin Panel</a>
                </div>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>Thank you for using {{ config('app.name') }}. If you have any questions, please contact our support team.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
