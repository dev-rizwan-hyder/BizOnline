<!DOCTYPE html>
<html>
<head>
    <title>New Contact Inquiry</title>
</head>
<body>
    <h2>New Contact Inquiry from {{ $data['first_name'] }} {{ $data['last_name'] }}</h2>
    <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    @if(!empty($data['phone']))
        <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    @endif
    <p><strong>Message:</strong><br>
    {!! nl2br(e($data['message'])) !!}</p>
</body>
</html>
