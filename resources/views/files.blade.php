@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td>{{ $file->original_name }} </td>
                        <td>{{ $file->size / 1000 }} </td>
                        <td><a href="{{ route('download', ['id' => $file->id ]) }}" target="_blank">Download</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection