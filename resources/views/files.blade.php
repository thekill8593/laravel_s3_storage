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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td>{{ $file->original_name }} </td>
                        <td>{{ $file->size / 1000 }} </td>
                        <td>
                            <a class="btn btn-primary mb-2" href="{{ route('download', ['id' => $file->id ]) }}"
                                target="_blank">Download</a>
                            <form action="{{ route('delete', ['id' => $file->id ]) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-primary" value="Delete">
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection