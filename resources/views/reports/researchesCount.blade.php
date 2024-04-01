<!DOCTYPE html>
<html>
<head>
    <title>Research List Table</title>
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
        <h4>List of All Researches</h4>
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
            @foreach ($researches as $research)
                <tr>
                    <td>{{ $research->research_title }}</td>
                    <td>{{ $research->abstract }}</td>
                    <td>{{ $research->department }}</td>
                    <td>{{ $research->course }}</td>
                    <td>
                        @if ($research->faculty_adviser1 != null)
                            {{ $research->faculty_adviser1 }},<br>     
                        @endif
                        @if ($research->faculty_adviser2 != null)
                            {{ $research->faculty_adviser2 }},<br>     
                        @endif
                        @if ($research->faculty_adviser3 != null)
                            {{ $research->faculty_adviser3 }},<br>     
                        @endif
                        @if ($research->faculty_adviser4 != null)
                            {{ $research->faculty_adviser4 }},<br>     
                        @endif
                    </td>
                    <td>
                        @if ($research->researcher1 != null)
                            {{ $research->researcher1 }},<br>     
                        @endif
                        @if ($research->researcher2 != null)
                            {{ $research->researcher2 }},<br>     
                        @endif
                        @if ($research->researcher3 != null)
                            {{ $research->researcher3 }},<br>     
                        @endif
                        @if ($research->researcher4 != null)
                            {{ $research->researcher4 }},<br>     
                        @endif
                        @if ($research->researcher5 != null)
                            {{ $research->researcher5 }},<br>     
                        @endif
                        @if ($research->researcher6 != null)
                            {{ $research->researcher6 }},<br>     
                        @endif
                    </td>
                    <td>{{ $research->date_completion }}</td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</body>
</html>
