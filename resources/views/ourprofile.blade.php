<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    {{-- <h1>Hello {{$name}}!</h1> --}}
    <h1>Hello {{$user->name}}, your email is {{$user->email}}, and your role is {{$user->role}}!</h1>
</body>

</html>
