<!DOCTYPE html>
<html>
<head>
    <title>Researches Count by Department</title>
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
        <h3>Researches Count by Department</h3>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Department</th>
                <th scope="col">Researches Counts by Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researchDepartmentCount as $researchDepartmentCounts)
                <tr>
                    <td>{{ $researchDepartmentCounts->department }}</td>
                    <td>{{ $researchDepartmentCounts->count }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Research Title</th>
                <th scope="col">Time Frame</th>
                <th scope="col">Date Completion</th>
                <th scope="col">Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($research as $researchs)
                <tr>
                    <td>{{ $researchs->id }}</td>
                    <td>{{ $researchs->research_title}}</td>>
                    <td>{{ $researchs->time_frame }}</td>
                    <td>{{ $researchs->date_completion }}</td>
                    <td>{{ $researchs->department }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
