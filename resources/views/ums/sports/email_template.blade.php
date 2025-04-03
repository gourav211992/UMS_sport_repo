<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            font-size: 15px;
            color: #2c3e50;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-weight: 600;
            font-size: 24px;
        }
        .email-content {
            padding: 30px;
        }
        .email-content p {
            margin-bottom: 20px;
            color: #34495e;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.3s ease;
            margin-top: 20px;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .email-footer {
            background-color: #f1f4f8;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #7f8c8d;
        }
        .logo-placeholder {
            width: 120px;
            height: 40px;
            background-color: rgba(255,255,255,0.2);
            margin: 0 auto 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" style="padding: 20px;">
            <div class="email-container">
                <div class="email-header">
                    <h1>Verify Your Email Address</h1>
                </div>

                <div class="email-content">
                    <p>Dear <b>{{ $user->first_name }}</b>,</p>

                    <p>Thank you for registering with Sport Quest. Please click the button below to verify your email address:</p>

                    <div style="text-align: center;">
                        <a href="{{ $verificationLink }}" class="cta-button">Verify Email Address</a>
                    </div>

                    <p>If you did not register, please ignore this email.</p>

                    <p>Sincerely,<br>
                        <strong>Sport Quest</strong></p>
                </div>

                <div class="email-footer">
                    © 2024 Sport Quest. All Rights Reserved.
                    <br>Confidential Communication
                </div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
