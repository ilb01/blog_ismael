<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post {{$post->id}}</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff9800, #ff5722);
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .post-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }
        .post-container:hover {
            transform: scale(1.05);
        }
        h1 {
            color: #ff5722;
            margin-bottom: 10px;
        }
        p {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
        }
        strong {
            color: #d84315;
        }
    </style>
</head>

<body>
    <div class="post-container">
        <h1>Post {{$post->id}}</h1>
        <p><strong>Title:</strong> {{$post->title}}</p>
        <p><strong>Content:</strong> {!!$post->content!!}</p>
        <p><strong>Posted:</strong> {{$post->created_at}}</p>
    </div>
</body>

</html>
