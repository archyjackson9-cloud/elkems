<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #3DBDA0; padding: 28px 32px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; letter-spacing: 1px; }
        .header p { color: rgba(255,255,255,.85); margin: 6px 0 0; font-size: 13px; }
        .body { padding: 32px; }
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 4px; }
        .field .value { font-size: 15px; color: #222; line-height: 1.6; }
        .message-box { background: #f8f9fa; border-left: 4px solid #3DBDA0; padding: 16px 20px; border-radius: 0 6px 6px 0; font-size: 15px; color: #333; line-height: 1.7; white-space: pre-wrap; }
        .footer { background: #f8f9fa; text-align: center; padding: 18px; font-size: 12px; color: #aaa; }
        .btn { display: inline-block; margin-top: 20px; background: #3DBDA0; color: #fff; padding: 12px 28px; border-radius: 5px; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>ELD Solutions Ltd</h1>
        <p>New Contact Form Submission</p>
    </div>
    <div class="body">
        <p style="color:#555; margin-bottom:24px;">You have received a new message through the website contact form.</p>

        <div class="field">
            <label>From</label>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>
        <div class="field">
            <label>Email</label>
            <div class="value"><a href="mailto:{{ $contactMessage->email }}" style="color:#3DBDA0;">{{ $contactMessage->email }}</a></div>
        </div>
        @if($contactMessage->subject)
        <div class="field">
            <label>Subject</label>
            <div class="value">{{ $contactMessage->subject }}</div>
        </div>
        @endif
        <div class="field">
            <label>Message</label>
            <div class="message-box">{{ $contactMessage->message }}</div>
        </div>
        <div class="field">
            <label>Received</label>
            <div class="value">{{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</div>
        </div>

        <a href="{{ url('/admin/messages') }}" class="btn">View in Admin Panel</a>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} ELD Solutions Ltd &mdash; Accra, Ghana
    </div>
</div>
</body>
</html>
