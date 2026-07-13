<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #00466b;
            color: #ffffff;
            text-align: center;
            padding: 15px 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f5f5f5;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Product Rejection Notification</h1>
        </div>
        <div class="content">
            <p>Dear Supplier,</p>
            <p>We regret to inform you that the following product has been rejected:</p>
            <h2>Product Name: {{ $product->productname }}</h2>
            <p><strong>Reason for Rejection:</strong></p>
            <div>{!! $reason !!}</div>
            <p>Thank you for your understanding.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Daatrade &copy;. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
