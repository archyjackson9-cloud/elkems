<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for contacting ELD Solutions</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #3DBDA0; padding: 32px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 24px; }
        .header p { color: rgba(255,255,255,.85); margin: 8px 0 0; }
        .body { padding: 32px; color: #444; line-height: 1.7; }
        .highlight { background: #f0fbf8; border-left: 4px solid #3DBDA0; padding: 14px 18px; border-radius: 0 6px 6px 0; margin: 20px 0; color: #333; white-space: pre-wrap; font-size: 14px; }
        .footer { background: #f8f9fa; text-align: center; padding: 18px; font-size: 12px; color: #aaa; border-top: 1px solid #eee; }
        .divider { border: none; border-top: 1px solid #eee; margin: 24px 0; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>ELD Solutions Ltd</h1>
        <p>Delivering Excellence Across Every Project</p>
    </div>
    <div class="body">
        <p>Dear <strong>{{ $contactMessage->name }}</strong>,</p>
        <p>Thank you for reaching out to us. We have received your message and our team will get back to you within <strong>1–2 business days</strong>.</p>

        <hr class="divider">
        <p style="font-size:13px; color:#888; margin-bottom:8px;">Your message summary:</p>
        @if($contactMessage->subject)
            <p style="font-size:13px; color:#888; margin-bottom:4px;"><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
        @endif
        <div class="highlight">{{ $contactMessage->message }}</div>
        <hr class="divider">

        <p>In the meantime, feel free to reach us directly:</p>
        <p>
            📞 <strong>Phone:</strong> +233 XX XXX XXXX<br>
            ✉️ <strong>Email:</strong> info@eldsolutions.com<br>
            📍 <strong>Location:</strong> Accra, Ghana
        </p>

        <p>Warm regards,<br><strong>ELD Solutions Ltd</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} ELD Solutions Ltd &mdash; Accra, Ghana<br>
        This is an automated response. Please do not reply directly to this email.
    </div>
</div>
</body>
</html>
