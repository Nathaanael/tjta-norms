<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results History for {{ $user->name }}</title>
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
            max-width: 800px;
        }
        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
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
        <h1>Results History for {{ $user->name }} ({{ $user->gender }})</h1>

        @if($results->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Letter</th>
                        <th>Raw Score</th>
                        <th>Value</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->letter }}</td>
                            <td>{{ $result->raw_score }}</td>
                            <td>{{ $result->value }}</td>
                            <td>{{ $result->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No results found for this user.</p>
        @endif

        <a href="{{ route('users.choose') }}" class="back-link">Back</a>
    </div>
</body>
</html>
