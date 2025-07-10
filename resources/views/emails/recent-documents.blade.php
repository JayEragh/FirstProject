<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recent Documents - DOCmag</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .document {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .document h3 {
            margin: 0 0 10px 0;
            color: #007bff;
        }
        .document p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📄 Recent Documents</h1>
        <p>Hello {{ $user->firstname }} {{ $user->lastname }},</p>
    </div>
    
    <div class="content">
        <p>Here are the most recent documents uploaded to DOCmag in the last 7 days:</p>
        
        @if($recentDocuments->count() > 0)
            @foreach($recentDocuments as $document)
                <div class="document">
                    <h3>{{ $document->title }}</h3>
                    <p><strong>Uploaded by:</strong> {{ $document->user->firstname }} {{ $document->user->lastname }}</p>
                    @if($document->description)
                        <p><strong>Description:</strong> {{ $document->description }}</p>
                    @endif
                    <p><strong>Date:</strong> {{ $document->date->format('M d, Y') }}</p>
                    <p><strong>Uploaded:</strong> {{ $document->created_at->format('M d, Y H:i') }}</p>
                </div>
            @endforeach
        @else
            <p>No new documents have been uploaded in the last 7 days.</p>
        @endif
        
        <p style="margin-top: 20px;">
            <strong>Total recent documents:</strong> {{ $recentDocuments->count() }}
        </p>
    </div>
    
    <div class="footer">
        <p>This email was sent from DOCmag Document Management System</p>
        <p>If you have any questions, please contact your system administrator.</p>
    </div>
</body>
</html> 