@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <upload-component url="{{ route('upload') }}" />
        
    </div>
    <a href="{{ route('files') }}">Files uploaded</a>
</div>
@endsection