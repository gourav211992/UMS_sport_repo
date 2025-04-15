<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Approved</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white;
            text-align: center;
            padding: 25px;
        }
        .email-header h1 {
            margin: 0;
            font-weight: 600;
            font-size: 28px;
            letter-spacing: -0.5px;
        }
        .email-content {
            padding: 35px;
        }
        .approval-badge {
            width: 120px;
            height: 120px;
            background: #00b09b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .approval-badge svg {
            width: 70px;
            height: 70px;
            fill: white;
        }
        .email-content p {
            margin-bottom: 20px;
            color: #34495e;
        }
        .next-steps {
            background-color: #f9f9f9;
            border-left: 4px solid #00b09b;
            padding: 15px;
            margin: 25px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.3s ease;
            margin-top: 20px;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .email-footer {
            background-color: #f4f7f6;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" style="padding: 20px;">
            <div class="email-container">
                <div class="email-header">
                    <h1>Sport Quest Profile Approval Notification</h1>
                </div>

                <div class="email-content">
{{--                    <div class="approval-badge">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">--}}
{{--                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}

                    <p>Dear {{$name}},</p>

                    <p>We are excited to inform you that your profile has been thoroughly reviewed and <strong>APPROVED</strong>. Congratulations on successfully completing our verification process!</p><br>
                    <p>Registration Number: {{$registration_number}}</p>


                    <div style="text-align: center;">
                        <a href="{{route('sports.login')}}" class="cta-button">Access Your Profile</a>
                    </div>

                    <p>If you have any questions or need further assistance, please contact our support team.</p>

                    <p>Best regards,<br>
                        <strong>Sport Quest</strong></p>
                </div>

                <div class="email-footer">
                    © 2024 Your Company Name. All Rights Reserved.
                    <br>Confidential Communication
                </div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>