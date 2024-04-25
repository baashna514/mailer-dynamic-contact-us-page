<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f2f2; /* Light gray background */
            color: #444;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff; /* White container background */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 28px;
            color: #007bff;
            margin: 0;
        }
        .header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .content {
            margin-bottom: 30px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .contact-info li {
            margin-bottom: 10px;
        }
        .message {
            margin-bottom: 30px;
        }
        .message p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container" style="background: #e9e9e9;">
    <div class="header">
        <img src="https://via.placeholder.com/150" alt="Company Logo">
        <h1>Contact Form Submission</h1>
    </div>
    <div class="content">
        <p>Dear Ashraf,</p>
        <p>You have received a contact form submission. Please find the details below:</p>
    </div>
    <div class="contact-info">
        <ul>
            <li><strong>Name:</strong> {{ $name }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Phone:</strong> {{ $phone }}</li>
        </ul>
    </div>
    <div class="message">
        <p><strong>Message:</strong></p>
        <p>{{ $content }}</p>
    </div>
    <div class="footer">
        <p>Please respond promptly to this inquiry.</p>
        <p>Best regards</p>
    </div>
</div>
</body>
</html>
