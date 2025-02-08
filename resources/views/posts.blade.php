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
    <div class="mt-12 w-full max-w-4xl">
        <h2 class="text-4xl font-bold text-center text-white mb-8">Últimos Posts</h2>

        @foreach ($posts as $post)
            <div class="post-container bg-white/20 border border-gray-300/30 backdrop-blur-lg shadow-lg rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-white">Post {{ $post->id }}</h3>
                <p class="text-xl text-yellow-300"><strong>Title:</strong> {{ $post->title }}</p>
                <p class="text-white"><strong>Content:</strong> {!! $post->content !!}</p>
                <p class="text-gray-300"><strong>Posted:</strong> {{ $post->created_at->format('d M Y') }}</p>
            </div>
        @endforeach
    </div>
</body>

</html>
