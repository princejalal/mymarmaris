@extends('adminpanel.layouts.app')

@section('content')
    <div class="container-fluid">
        <p class="alert alert-primary">Select File</p>
        <div class="row">
            @foreach ($languages as $lang)
                <div class="col-md-4 my-5"><a class="btn btn-success" href="{{ route('files.show',$lang->lang_short_name) }}">{{ $lang->lang_name }}</a></div>
            @endforeach
        </div>
    </div>
@endsection
