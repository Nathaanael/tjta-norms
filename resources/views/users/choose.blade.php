<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        .success {
            color: green;
            margin-bottom: 1rem;
        }
        .user-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .user-list li {
            margin-bottom: .5rem;
        }
        .user-list a {
            text-decoration: none;
            color: #007bff;
            padding: .5rem;
            display: block;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: background-color 0.3s, color 0.3s;
        }
        .user-list a:hover {
            background-color: #007bff;
            color: #fff;
        }
        a.back-link {
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Choose User</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <ul class="user-list">
            @foreach ($names as $name)
                <li>
                    <a href="{{ route('input.input', $name->id) }}">{{ $name->name }} ({{ $name->gender }})</a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('landing') }}" class="back-link">Back</a>
    </div>
</body>
</html>
