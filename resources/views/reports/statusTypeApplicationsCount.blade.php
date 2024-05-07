<!DOCTYPE html>
<html>
<head>
    <title>Application Count By Status Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h3>Application Count By Status Table</h3>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Requestor Name</th>
                <th scope="col">Requestor Type</th>
                <th scope="col">Thesis Type</th>
                <th scope="col">Application Title</th>
                <th scope="col">Submission Frequency</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->requestor_name}}</td>>
                    <td>{{ $application->requestor_type }}</td>
                    <td>{{ $application->thesis_type }}</td>
                    <td>{{ $application->research_title }}</td>
                    <td>{{ $application->submission_frequency }}</td>
                    <td>{{ $application->status }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
