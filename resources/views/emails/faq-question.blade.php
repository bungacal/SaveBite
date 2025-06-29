<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New FAQ Question - Save Bite</title>
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
            background-color: #c23d3d;
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
            color: #c23d3d;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .user-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .user-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-info td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .user-info td:first-child {
            font-weight: bold;
            width: 120px;
            color: #666;
        }
        .question-content {
            background-color: #fff;
            border: 2px solid #c23d3d;
            border-radius: 6px;
            padding: 20px;
            margin-top: 20px;
        }
        .question-content h3 {
            margin-top: 0;
            color: #c23d3d;
            font-size: 18px;
        }
        .question-text {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #c23d3d;
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
        .action-note {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
        .action-note strong {
            color: #856404;
        }
        .technical-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin-top: 15px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Save Bite - New FAQ Question</h1>
        </div>
        
        <div class="email-body">
            <h2>New Question Submitted</h2>
            <p>A user has submitted a new question through the FAQ page that may need to be addressed.</p>
            
            <div class="user-info">
                <table>
                    <tr>
                        <td>Submitted by:</td>
                        <td>{{ $userName }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            @if($userEmail !== 'No email provided')
                                <a href="mailto:{{ $userEmail }}">{{ $userEmail }}</a>
                            @else
                                {{ $userEmail }} (Anonymous user)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Submitted on:</td>
                        <td>{{ $submittedAt->format('F d, Y \a\t H:i') }}</td>
                    </tr>
                    <tr>
                        <td>User Type:</td>
                        <td>{{ $userEmail !== 'No email provided' ? 'Registered User' : 'Anonymous Visitor' }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="question-content">
                <h3>Question:</h3>
                <div class="question-text">
                    {{ $userQuestion }}
                </div>
            </div>

            <div class="action-note">
                <strong>Action Required:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Review this question for potential addition to the FAQ section</li>
                    <li>Consider if this indicates a common user concern</li>
                    @if($userEmail !== 'No email provided')
                    <li>You can reply directly to this email to respond to the user</li>
                    @endif
                    <li>Update FAQ content if necessary to address this type of question</li>
                </ul>
            </div>

            <div class="technical-info">
                <strong>Technical Information:</strong><br>
                IP Address: {{ $ipAddress }}<br>
                User Agent: {{ $userAgent }}<br>
                Submission Time: {{ $submittedAt->format('Y-m-d H:i:s T') }}
            </div>
        </div>
        
        <div class="email-footer">
            <p>This question was submitted through the Save Bite FAQ page.</p>
            <p>Save Bite - Fighting hunger, reducing waste</p>
        </div>
    </div>
</body>
</html>