@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create')  }} {{ locale_words('Name') }} {{ locale_words('Slider') }}</h4>
        <hr/>
        @if(isset($slider->slider_id))
            {!! Form::open(['url' => route('slider.update',$slider->slider_id),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            {!! Form::open(['url' => route('slider.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('slider_name',locale_words('Slider') . ' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('slider_name',check_property($slider,'slider_name'),['class'=>'form-control']) !!}
                @error('slider_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('image',locale_words('Image'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control']) !!}
                <br>
                @if(isset($slider->image))
                    <img src="{{ asset('content/images/slider/' .  $slider->image) }}" width="500" height="200">
                @endif
                @error('image')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                @if(isset($slider->slider_id))
                    {!!  Form::submit(locale_words('Edit'),['class'=>'btn btn-default']) !!}
                @else
                    {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
