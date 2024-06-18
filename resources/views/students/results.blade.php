@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Matching Titles Results for "{{ $inputTitle }}"</h5> 

            @if (!empty($titles))
                <ul class="list-group">
                    @foreach ($titles as $title)
                        <li class="list-group-item">
                            <button type="button" class="btn btn-primary" onclick="copyText('researchTitle{{ $loop->index }}')">
                                <i class="bx bxs-copy-alt"></i>
                            </button>
                            <span id="researchTitle{{ $loop->index }}" style="padding-left: 10px">
                                {{ $title['research_title'] }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No matching titles found.</p>
            @endif
            <br>
            <span>
                For more details, copy the specific title and paste it into the 
                <a href="{{url('student/title-checker')}}">Research List</a> 
                to find the information you need.
            </span>
        </div>
    </div>

</main>
<script>
    function copyText(elementId) {
        var textElement = document.getElementById(elementId);
        var text = textElement.innerText || textElement.textContent;

        navigator.clipboard.writeText(text)
            .then(() => {
                Swal.fire({
                    icon: "success",
                    title: "Text copied to clipboard",
                    text: text,
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(err => {
                console.error("Failed to copy text: ", err);
                Swal.fire({
                    icon: "error",
                    title: "Failed to copy text",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
    }
</script>