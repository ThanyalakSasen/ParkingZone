<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 50px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        .container h1 {
            color: #28a745;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .container p {
            font-size: 1.1rem;
            color: #333;
            margin: 10px 0;
        }
        .container .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        .button {
            margin-top: 30px;
        }
        .button a {
            background-color: #000048;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1rem;
        }
        .button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✔</div>
        <h1>ชำระเงินสำเร็จ!</h1>
        <p>ขอบคุณที่ใช้บริการ</p>
        <div class="button">
            <a href="{{ url('/') }}">Back to Home</a>
        </div>
    </div>
</body>
</html>
