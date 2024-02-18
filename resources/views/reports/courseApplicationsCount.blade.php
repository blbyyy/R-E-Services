<!DOCTYPE html>
<html>
<head>
    <title>Application Count by Course</title>
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
        <h3>Application Count by Course</h3>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Courses</th>
                <th scope="col">Application Counts by Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courseCount as $courseCounts)
                <tr>
                    <td>{{ $courseCounts->course }}</td>
                    <td>{{ $courseCounts->count }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Requestor Name</th>
                <th scope="col">Requestor Type</th>
                <th scope="col">Course</th>
                <th scope="col">Thesis Type</th>
                <th scope="col">Submission Frequency</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->requestor_name}}</td>>
                    <td>{{ $application->requestor_type }}</td>
                    <td>{{ $application->course }}</td>
                    <td>{{ $application->thesis_type }}</td>
                    <td>{{ $application->submission_frequency }}</td>
                    <td>{{ $application->status }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
