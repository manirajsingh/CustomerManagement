<!-- resources/views/emails/mfa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA Code</title>
</head>
<body>
    <h1>Your MFA Code</h1>
    <p>Your MFA code is: <strong>{{ $mfa_code }}</strong></p>
</body>
</html>
