<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Norms Lookup</title>
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
        form {
            margin-bottom: 2rem;
        }
        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
        }
        input[type="number"], 
        select {
            width: 100%;
            padding: .5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        input[type="number"]:focus, 
        select:focus {
            border-color: #007bff;
            outline: none;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: .75rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .no-results {
            margin-top: 1rem;
            font-style: italic;
            color: #666;
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
        <h1>TJTA Norms Lookup for {{ $user->name }} ({{ $user->gender }})</h1>
        
        <form action="{{ route('input.lookup') }}" method="POST">
            @csrf
            <label for="raw_score">Raw Score:</label>
            <input type="number" id="raw_score" name="raw_score" required>

            <label for="letter">Letter:</label>
            <select id="letter" name="letter" required>
                <option value="nervous">A</option>
                <option value="depressive">B</option>
                <option value="active_social">C</option>
                <option value="expressive_responsive">D</option>
                <option value="sympathetic">E</option>
                <option value="subjective">F</option>
                <option value="dominant">G</option>
                <option value="hostile">H</option>
                <option value="self_disciplined">I</option>
            </select>

            <button type="submit">Lookup</button>
        </form>

        @if($user->results && $user->results->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Letter</th>
                        <th>Raw Score</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->results as $result)
                        <tr>
                            <td>{{ $result->letter }}</td>
                            <td>{{ $result->raw_score }}</td>
                            <td>{{ $result->value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-results">No results found for this user.</p>
        @endif

        <a href="{{ route('users.choose') }}" class="back-link">Back</a>
    </div>

</body>
</html>
