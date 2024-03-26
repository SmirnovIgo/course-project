<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Information</title>
</head>
<body>
    <h1>Trainer Information</h1>
    <ul>
        <li><strong>Name:</strong> {{ $trainer->name }}</li>
        <li><strong>Email:</strong> {{ $trainer->email }}</li>
        <li><strong>Password:</strong> {{ $trainer->password }}</li>
    </ul>
</body>
</html>
