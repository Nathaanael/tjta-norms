<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
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
            max-width: 400px;
        }
        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
        }
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: .5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group input:focus, 
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        .error {
            color: red;
            font-size: .875rem;
        }
        .success {
            color: green;
            margin-bottom: 1rem;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: .75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create User</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender">
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Create User</button>
        </form>
        <a href="{{ route('landing') }}">Back</a>
    </div>
</body>
</html>
