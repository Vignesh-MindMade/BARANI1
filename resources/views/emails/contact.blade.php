<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 650px;
        margin: 40px auto;
        background-color: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    .header {
        background: linear-gradient(135deg, #d4af37, #000000);
        padding: 25px;
        text-align: center;
        color: #fff;
    }
    .header img {
        max-width: 140px;
        margin-bottom: 10px;
    }
    .header h2 {
        font-size: 26px;
        margin: 0;
        font-weight: 600;
    }
    .content {
        padding: 30px;
    }
    .info {
        background-color: #fafafa;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 15px;
        border: 1px solid #eee;
    }
    .info strong {
        color: #d4af37;
        display: inline-block;
        width: 80px;
    }
    .message-box {
        background-color: #fff8e7;
        padding: 20px;
        border-left: 5px solid #d4af37;
        border-radius: 10px;
        font-size: 15px;
        line-height: 1.6;
        color: #555;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    }
    .footer {
        text-align: center;
        background-color: #000000;
        padding: 20px;
        font-size: 14px;
        color: #d4af37;
    }
    .footer a {
        color: #d4af37;
        text-decoration: underline;
    }
    @media only screen and (max-width: 600px) {
        .container {
            margin: 15px;
        }
        .header h2 {
            font-size: 22px;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://mindmadetech.in/vetal/assets/images/logo/vital-logo.svg" alt="Vital Logo">
            <h2>📩 New Contact Message</h2>
        </div>
        <div class="content">
            <div class="info">
                <strong>Name:</strong> {{ $data['name'] }}
            </div>
            <div class="info">
                <strong>Email:</strong> {{ $data['email'] }}
            </div>
            <div class="info">
                <strong>Subject:</strong> {{ $data['subject'] }}
            </div>
            <p style="margin-top:20px; font-weight:600; color:#333;">Message:</p>
            <div class="message-box">
                {{ $data['message'] }}
            </div>
        </div>
        <div class="footer">
            <p>Thank you for reaching out! We'll get back to you soon.</p>
            <p><a href="https://mindmadetech.in">🌐 Visit Our Website</a></p>
        </div>
    </div>
</body>
</html>
