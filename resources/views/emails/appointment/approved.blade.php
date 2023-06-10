<!DOCTYPE html>
<html>
<head>
    <title>Appointment Approved</title>
</head>
<body>
    <h1>Your appointment has been approved!</h1>
    <p>Dear {{ $name }},</p>
    <p>Your appointment request has been approved. Please find the details below:</p>
    <ul>
        <li>Date: {{ $date }}</li>
        <li>Doctor: {{ $doctor }}</li>
        <!-- Include any other appointment details you want to display -->
    </ul>
    <p>Thank you for choosing our services.</p>
</body>
</html>
