@extends('adminpanel.layouts.app')

@section('content')
    <div class="container-fluid">
        <p class="alert alert-primary">Select One Language</p>
        <div class="row">
            @foreach ($files as $file)
                <div class="col-md-4 my-5"><a class="btn btn-success" href="{{ route('files.show',[$lng,'file' =>$file]) }}">{{ $file }}</a></div>
            @endforeach
        </div>
    </div>
@endsection