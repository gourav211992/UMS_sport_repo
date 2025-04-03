<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Your Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .container p {
            margin-bottom: 10px;
            color: #555;
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container button {
            background-color: #7367f0 ;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #7367f0 ;
        }

        .timer {
            color: #999;
            margin-bottom: 10px;
        }

        .back-home {
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }

        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @else
        <h2>Enter Your Verification Code</h2>
        <p>Thank you for your job posting. Please type the OTP as shared on your mobile ending in {{$mobile}}.</p>
    @endif

    <form action="{{ route('verify.otp') }}" method="POST">
        @csrf
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <input type="hidden" name="email" value="{{$email}}" required>
{{--        <p class="timer">1m 57s</p>--}}
        <button type="submit">Submit</button>
    </form>

{{--    <a href="" class="back-home">Go back to home</a>--}}
</div>
</body>
</html>
