<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Quest - Application Review</title>
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
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
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
        .rejection-badge {
            width: 120px;
            height: 120px;
            background: #ff6b6b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .rejection-badge svg {
            width: 70px;
            height: 70px;
            fill: white;
        }
        .email-content p {
            margin-bottom: 20px;
            color: #34495e;
        }
        .admin-remarks {
            background-color: #f9f9f9;
            border-left: 4px solid #ff6b6b;
            padding: 15px;
            margin: 25px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #4ecdc4, #45b7d1);
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
                    <h1>Sport Quest Application Review</h1>
                </div>

                <div class="email-content">
{{--                    <div class="rejection-badge">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">--}}
{{--                            <path d="M12 2L2 22h20L12 2zm1 18h-2v-2h2v2zm0-4h-2V8h2v8z"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}

                    <p>Dear {{$name}},</p>

                    <p>We appreciate the time and effort you've invested in applying to Sport Quest. After a comprehensive review of your application, we regret to inform you that your submission has not been approved at this time.</p>

                    <div class="admin-remarks">
                        <p><strong>Administrator's Remarks:</strong></p>
                        <p>{{$remarks}}</p>

                        </p>
                    </div>

                    <p>While your current application was not successful, we encourage you to take this as an opportunity for growth and development.</p>

                    <div style="text-align: center;">
                        <a href="{{route('sports.login')}}" class="cta-button">Resubmit Your Application</a>
                    </div>

                    <p>You are welcome to revise and resubmit your application after addressing the feedback provided. Our team is committed to helping talented individuals succeed.</p>

                    <p>Best regards,<br>
                        <strong>Sport Quest Admissions Team</strong></p>
                </div>

                <div class="email-footer">
                    © 2024 Sport Quest Academy. All Rights Reserved.
                    <br>Confidential Communication
                </div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>