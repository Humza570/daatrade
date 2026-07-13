<!DOCTYPE html>
<html>

<head>
    <title>NewsLetter</title>
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
            <h1>Daatrade Member Notice</h1>
        </div>
        <div class="content">
            <div>
                <p>Congratulations! You have created a member account on <a href="https://daatrade.com/">https://daatrade.com/</a> successfully!</p>
                <p>Your account information is as follows:</p>
                <p><strong>Account:</strong> {{$user->email}}</p>
                <p><strong>Password:</strong> {{$password}}</p>
                <p>As a new member, please select a <a href="https://daatrade.com/membershipplan">Membership</a> Plan to access the following services now:</p>
                <ul>
                    <li>(1) Create Company Account - show your business and export products to clients quickly.</li>
                    <li>(2) Display Stone Products - get your own private inquiries easily.</li>
                    <li>(3) Upload Photo Gallery - quarry, fair, etc.</li>
                </ul>
                <p>Our Premium Showcase Membership offers:</p>
                <ul>
                    <li>Up to 45 product listings</li>
                    <li>Priority placement in all relevant categories.</li>
                    <li>Featured homepage display.</li>
                    <li>Weekly promotion on Daatrade's social media channels (10 posts/month)</li>
                </ul>
                <p>Welcome to contact us to get Premium Membership discount cost and promotion anytime.</p>
                <p>WeChat: +92 341 1115888</p>
                <p>WhatsApp: +92 341 1115888</p>
                <p>Email: <a href="mailto:info@daatrade.com">info@daatrade.com</a></p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Daatrade &copy;. All rights reserved.</p>
        </div>
    </div>
</body>

</html>