<!DOCTYPE html>
<html>
<head>
    <title>Researches Count by Course</title>
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
        <h3>Researches Count by Course</h3>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Course</th>
                <th scope="col">Researches Counts by Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researchCourseCount as $researchCourseCounts)
                <tr>
                    <td>{{ $researchCourseCounts->course }}</td>
                    <td>{{ $researchCourseCounts->count }}</td>
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
                <th scope="col">Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($research as $researchs)
                <tr>
                    <td>{{ $researchs->id }}</td>
                    <td>{{ $researchs->research_title}}</td>>
                    <td>{{ $researchs->time_frame }}</td>
                    <td>{{ $researchs->date_completion }}</td>
                    <td>{{ $researchs->course }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
