@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">File upload</div>

                <div class="card-body">
                    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" multiple name="files[]" class="form-control" />

                        <br />
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </form>

                </div>
            </div>


            <a class="d-block my-4" href="{{ route('uploadvue') }}">Upload with Vue JS</a>

            <a href="{{ route('files') }}">Files uploaded</a>
        </div>
    </div>
</div>
@endsection