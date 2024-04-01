<!DOCTYPE html>
<html>
<head>
    <title>Research List By Year</title>
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
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h4>List of Researches of Year</h4>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Research Title</th>
                <th scope="col">Abstract</th>
                <th scope="col">Department</th>
                <th scope="col">Course</th>
                <th scope="col">Faculty Adviser</th>
                <th scope="col">Researchers</th>
                <th scope="col">Date Completion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($research as $researches)
                <tr>
                    <td>{{ $researches->research_title }}</td>
                    <td>{{ $researches->abstract }}</td>
                    <td>{{ $researches->department }}</td>
                    <td>{{ $researches->course }}</td>
                    <td>
                        @if ($researches->faculty_adviser1 != null)
                            {{ $researches->faculty_adviser1 }},<br>     
                        @endif
                        @if ($researches->faculty_adviser2 != null)
                            {{ $researches->faculty_adviser2 }},<br>     
                        @endif
                        @if ($researches->faculty_adviser3 != null)
                            {{ $researches->faculty_adviser3 }},<br>     
                        @endif
                        @if ($researches->faculty_adviser4 != null)
                            {{ $researches->faculty_adviser4 }},<br>     
                        @endif
                    </td>
                    <td>
                        @if ($researches->researcher1 != null)
                            {{ $researches->researcher1 }},<br>     
                        @endif
                        @if ($researches->researcher2 != null)
                            {{ $researches->researcher2 }},<br>     
                        @endif
                        @if ($researches->researcher3 != null)
                            {{ $researches->researcher3 }},<br>     
                        @endif
                        @if ($researches->researcher4 != null)
                            {{ $researches->researcher4 }},<br>     
                        @endif
                        @if ($researches->researcher5 != null)
                            {{ $researches->researcher5 }},<br>     
                        @endif
                        @if ($researches->researcher6 != null)
                            {{ $researches->researcher6 }},<br>     
                        @endif
                    </td>
                    <td>{{ $researches->date_completion }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
