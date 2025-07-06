<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Subscription Updated</title>
</head>
<body style="font-family: sans-serif; line-height: 1.5; color: #333;">
    <h2>Subscription Update Notification</h2>

    <p>Hello Jonah,</p>

    <p>The subscription for <strong>User #{{ $user->id }} ({{ $user->email }})</strong> was just updated:</p>

    <ul>
        <li><strong>Previous plan:</strong> {{ $oldPlanName }} (Price ID: {{ $oldPrice ?? 'n/a' }})</li>
        <li><strong>New plan:</strong> {{ $newPlanName }} (Price ID: {{ $newPrice ?? 'n/a' }})</li>
    </ul>

    <p><small>Change detected at {{ now()->toDayDateTimeString() }}</small></p>

    <p>—<br>Your SellOrDie App</p>
</body>
</html>
