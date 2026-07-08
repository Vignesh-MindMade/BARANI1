<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacOSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 32px 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px;
        }
        .info-box {
            background: #f8fafc;
            border-radius: 8px;
            padding: 24px;
            margin: 24px 0;
            border-left: 4px solid #6366f1;
        }
        .label {
            font-weight: 600;
            color: #4b5563;
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }
        .value {
            margin: 0 0 16px 0;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .message-box {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
        }
        .footer {
            background: #f8fafc;
            padding: 24px 40px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            background: #6366f1;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 16px;
        }
        h2 {
            color: #1f2937;
            font-size: 20px;
            margin: 0 0 20px;
        }
        @media only screen and (max-width: 600px) {
            .content, .header, .footer {
                padding: 24px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>New Contact Message Received</h1>
    </div>

    <div class="content">

        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 28px;">
            Hello Admin,<br><br>
            You have received a new message through the website contact form.
        </p>

        <div class="info-box">
            <span class="label">From</span>
            <p class="value">{{ $name }} <br><a href="mailto:{{ $email }}">{{ $email }}</a></p>

            <span class="label">Subject</span>
            <p class="value">{{ $subject }}</p>

            <span class="label">Received on</span>
            <p class="value">{{ now()->format('d M Y • h:i A') }}</p>
        </div>

        <h2>Message</h2>
        <div class="message-box">
            {!! nl2br(e($body)) !!}
        </div>

        <!--<p style="text-align: center; margin-top: 32px;">-->
        <!--    <a href="mailto:{{ $email }}?subject=Re: {{ urlencode($subject) }}" class="button">-->
        <!--        Reply to {{ $name }}-->
        <!--    </a>-->
        <!--</p>-->

    </div>

    <div class="footer">
        <p>This message was sent from the contact form on your website.<br>
        Barani © {{ date('Y') }} • All rights reserved.</p>
    </div>
</div>

</body>
</html>