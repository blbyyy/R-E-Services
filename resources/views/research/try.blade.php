@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Try</h5>

          {{-- <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{route('uploadpdf')}}">
             @csrf
             <div class="col-md-12">
                <label for="content" class="form-label">file</label>
                <input name="eyss" type="file" class="form-control" id="eyss">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- Vertical Form --> --}}

          <form action="{{ route('tryuploads') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="pdf_file">
            <button type="submit">Upload PDF</button>
          </form>

          <a href="{{ route('pdf.show', ['fileName' => '1700848238_Group2-DataProcessing.pdf']) }}" target="_blank">View PDF</a>
          <embed src="{{ route('pdf.show', ['fileName' => '1700848238_Group2-DataProcessing.pdf']) }}" type="application/pdf" width="100%" height="600px">

        </div>
      </div>
</main>