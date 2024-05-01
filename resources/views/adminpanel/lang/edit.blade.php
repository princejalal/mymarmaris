@extends('adminpanel.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row my-2">
            @foreach ($lang as $key => $value)
                {!! Form::open(['url' => route('files.update',$key)]) !!}
                {{ method_field('PUT') }}
                <input type="hidden" name="lng" value="{{ $lng }}">
                <input type="hidden" name="file" value="{{ $file }}">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-form-label" for="{{$key}}">{{ $key }}</label>
                        <textarea class="form-control" name="value_name" id="{{$key}}" cols="30" rows="3">{{$value}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6"><input type="submit" value="Edit" class="btn btn-success form-control"></div>
                            <div class="col-md-6"><input type="button" value="Delete" class="btn btn-danger form-control"></div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <hr>
            @endforeach
        </div>
    </div>
@endsection
