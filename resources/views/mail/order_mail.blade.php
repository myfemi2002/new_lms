<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .success-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .success-image {
            width: 50%;
            margin: 20px auto;
            border-radius: 8px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
            margin: 8px 0;
        }
        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <img src="{{ asset('upload/order-image.jpg') }}" alt="Cart on the way" class="success-image">
        <h2>Payment Successfully Processed</h2>
        <p>Your Order Details</p>
        <p>Invoice/Transaction ID: <strong>{{ $order['invoice_no'] }}</strong></p>
        <p>Course Name: <strong>{{ $order['course_title'] }}</strong></p>
        <p>Price: <strong> ${{ $order['amount'] }}</strong></p>
    </div>
</body>
</html>
