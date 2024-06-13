<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    @if (!empty($titles))
        <ul>
            @foreach ($titles as $title)
                <li>{{ $title['research_title'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No matching titles found.</p>
    @endif
</body>
</html>
