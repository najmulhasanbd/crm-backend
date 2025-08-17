<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Departments PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #2d3748;
            line-height: 1.4;
        }

        h2 {
            text-align: center;
            color: #1a202c;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #4a5568;
        }

        th {
            background-color: #4299e1; /* Blue header */
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #edf2f7; /* Light grey alternate row */
        }

        tr:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body>

    <h2>Department List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ ucwords($item->name) }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
