<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f9fafb; margin:0; padding:0; }
        .container { max-width:600px; margin:40px auto; background:#fff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb; }
        .header { background:#111827; padding:32px; text-align:center; }
        .header h1 { color:#fff; margin:0; font-size:22px; }
        .header span { color:#facc15; }
        .badge { display:inline-block; background:rgba(250,204,21,0.15); color:#facc15; border:1px solid rgba(250,204,21,0.3); padding:4px 12px; border-radius:20px; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-top:10px; }
        .body { padding:32px; }
        .field { margin-bottom:20px; }
        .field label { font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:6px; }
        .field p { font-size:14px; color:#111827; margin:0; background:#f9fafb; padding:12px 16px; border-radius:8px; border:1px solid #e5e7eb; line-height:1.6; }
        .footer { background:#f9fafb; border-top:1px solid #e5e7eb; padding:20px 32px; text-align:center; }
        .footer p { font-size:12px; color:#9ca3af; margin:0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Job<span>Connect</span> Bénin</h1>
        <div class="badge">Nouveau message de contact</div>
    </div>
    <div class="body">
        <div class="field">
            <label>De</label>
            <p>{{ $data['name'] }} &lt;{{ $data['email'] }}&gt;</p>
        </div>
        <div class="field">
            <label>Sujet</label>
            <p>{{ ucfirst($data['sujet']) }}</p>
        </div>
        <div class="field">
            <label>Message</label>
            <p>{{ $data['message'] }}</p>
        </div>
    </div>
    <div class="footer">
        <p>Message envoyé depuis jobconnect.bj — {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
</div>
</body>
</html>