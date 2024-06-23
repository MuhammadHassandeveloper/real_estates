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
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h1>{{ App\Helpers\AppHelper::site_name() }}</h1>
    </div>
    <div class="content">
        <h2>Contact Message From Customer</h2>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
        <p><strong>Message:</strong> {{ $message }}</p>
    </div>
    <div class="footer">
        <p>Thank you for contacting us!</p>
    </div>
</div>
</body>
</html>
