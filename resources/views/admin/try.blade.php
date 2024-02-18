<!-- resources/views/pdf/research-table.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Research Table PDF</title>
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
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Actions</th>
                <th scope="col">Research Title</th>
                <th scope="col">Department</th>
                <th scope="col">Course</th>
                <th scope="col">Date of Completion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researches as $research)
                <tr>
                    <td>
                        <button data-id="{{ $research->id }}" type="button" class="btn btn-info studentshowBtn" data-bs-toggle="modal" data-bs-target="#showstudentinfo"><i class="bi bi-eye"></i></button>
                        <button data-id="{{ $research->id }}" type="button" class="btn btn-primary studenteditBtn" data-bs-toggle="modal" data-bs-target="#editstudentinfo"><i class="bi bi-pencil-square"></i></button>
                        <button data-id="{{ $research->id }}" type="button" class="btn btn-danger studentdeleteBtn"><i class="bi bi-trash"></i></button>
                    </td>
                    <td>{{ $research->research_title }}</td>
                    <td>{{ $research->department }}</td>
                    <td>{{ $research->course }}</td>
                    <td>{{ $research->date_completion }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
