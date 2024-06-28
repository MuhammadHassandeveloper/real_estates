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
        .content {
            padding: 20px;
            color: #333333;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #777777;
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
<div class="email-container">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="header">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">
                <h1>New Property Created</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <h2>Property Details</h2>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><strong>Title:</strong></td>
                                    <td>{{ $property->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td>{{ $property->property_type_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Category:</strong></td>
                                    <td>{{ $property->property_category }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bedrooms:</strong></td>
                                    <td>{{ $property->bedrooms }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bathrooms:</strong></td>
                                    <td>{{ $property->bathrooms }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Size (sqft):</strong></td>
                                    <td>{{ $property->size_sqft }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Price:</strong></td>
                                    <td>{{ $property->price }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>{{ $property->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City:</strong></td>
                                    <td>{{ $property->city->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>State:</strong></td>
                                    <td>{{ $property->state->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Zip Code:</strong></td>
                                    <td>{{ $property->zip_code }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Building Age:</strong></td>
                                    <td>{{ $property->building_age }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>Agent/Agency Details</h2>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $agent->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $agent->phone }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="button-container">
                            <a href="{{ url('/login') }}" class="button">Login to Admin Panel</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>Thank you for using our service!</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
