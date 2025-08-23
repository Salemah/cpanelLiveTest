{{-- ==================================================================================================== --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$mailData['title']}} - Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
        }

        /* Header */
        .header {
            text-align: left;
            padding: 20px;
            border-bottom: 2px solid #005a8b;
            background-color: #f6f6f6;
            position: relative;
        }

        .header img {
            max-width: 160px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            position: absolute;
            right: 20px;
            top: 20px;
            margin: 0;
        }

        .header p a {
            color: #005a8b;
            text-decoration: none;
        }

        .strip {
            background-color: #005a8b;
            height: 5px;
            margin: 0;
        }

        /* Content */
        .content {
            padding: 20px;
        }

        .content h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .details p {
            margin: 6px 0;
            font-size: 14px;
            color: #333;
        }

        .support-links a {
            display: block;
            color: #005a8b;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background-color: #f6f6f6;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .footer a {
            color: #005a8b;
            text-decoration: none;
            margin: 0 10px;
        }

        .social-icons img {
            width: 30px;
            margin: 0 10px;
        }

        @media (max-width: 600px) {
            .email-container {
                width: 100%;
            }

            .header img {
                max-width: 140px;
            }

            .header p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            {{-- <img src="https://www.fastcloudx.com/img/logo.png" alt="Logo"> --}}
            <p> <a href="{{$mailData['website']}}">{{$mailData['title']}}</a></p>
        </div>

        <!-- Blue Strip Under Header -->
        <div class="strip"></div>

        <!-- Content Section -->
        <div class="content">
            <p>Dear {{$mailData['name']}},</p>
            <p>
                Your appointment has been successfully confirmed with <strong>{{$mailData['title']}}</strong>.
                Please find your appointment details below:
            </p>

            <!-- Appointment Details -->
            <div class="details">
                <p><strong>Consultant:</strong> {{$mailData['team_id']}}</p>
                <p><strong>Name:</strong> {{$mailData['name']}}</p>
                <p><strong>Email:</strong> {{$mailData['email']}}</p>
                <p><strong>Phone:</strong> {{$mailData['phone']}}</p>
                <p><strong>Appointment Date:</strong> {{$mailData['booking_date']}}</p>
                <p><strong>Appointment Time:</strong> {{$mailData['booking_time']}}</p>
                <p><strong>Amount:</strong> {{$mailData['amount']}} BDT</p>
                @if(!empty($mailData['notes']))
                    <p><strong>Notes:</strong> {{$mailData['notes']}}</p>
                @endif
            </div>

            <p>
                Please ensure to be available on time. If you have any questions or need to reschedule, kindly contact our support team.
            </p>

            <h2>Need Help?</h2>
            <p>
                You can access our support resources below:
            </p>
            <div class="support-links">
                <a href="{{$mailData['website']}}/knowledgebase">Knowledgebase</a>
                <a href="{{$mailData['website']}}/support">Submit a Ticket</a>
            </div>

            <p>--<br>{{$mailData['title']}}<br>
                <a href="{{$mailData['website']}}">{{$mailData['website']}}</a>
            </p>

            <p style="font-size: 12px; color: #777;">
                You are receiving this email because you booked an appointment with us. If this wasn’t you, please contact our support immediately.
            </p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <a href="{{$mailData['website']}}">{{$mailData['website']}}</a>
            <div class="social-icons">
                <a href="{{$mailData['facebook']}}"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
                <a href="{{$mailData['instagram']}}"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram"></a>
            </div>
            <p>
                <a href="{{$mailData['website']}}/login">Login to your account</a> |
                <a href="{{$mailData['website']}}/contact">Contact Us</a>
            </p>
            <p>&copy;  <script>document.write(new Date().getFullYear())</script>, {{$mailData['title']}}. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
