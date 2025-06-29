<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - Save Bite</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #b73e3e;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body h2 {
            color: #b73e3e;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .contact-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .contact-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .contact-info td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .contact-info td:first-child {
            font-weight: bold;
            width: 80px;
            color: #666;
        }
        .message-content {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 20px;
            margin-top: 20px;
        }
        .message-content h3 {
            margin-top: 0;
            color: #333;
            font-size: 16px;
        }
        .email-footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .timestamp {
            color: #999;
            font-size: 12px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Save Bite - Contact Form</h1>
        </div>
        
        <div class="email-body">
            <h2>New Contact Form Submission</h2>
            <p>You have received a new message through the Save Bite contact form.</p>
            
            <div class="contact-info">
                <table>
                    <tr>
                        <td>Name:</td>
                        <td>{{ $userName }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><a href="mailto:{{ $userEmail }}">{{ $userEmail }}</a></td>
                    </tr>
                    <tr>
                        <td>Subject:</td>
                        <td>{{ $userSubject }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td>{{ date('F d, Y \a\t H:i') }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="message-content">
                <h3>Message:</h3>
                <p>{{ nl2br(e($userMessage)) }}</p>
            </div>
            
            <div class="timestamp">
                <p><strong>Reply Instructions:</strong> You can reply directly to this email to respond to {{ $userName }}.</p>
            </div>
        </div>
        
        <div class="email-footer">
            <p>This email was sent from the Save Bite contact form.</p>
            <p>Save Bite - Fighting hunger, reducing waste</p>
        </div>
    </div>
</body>
</html>