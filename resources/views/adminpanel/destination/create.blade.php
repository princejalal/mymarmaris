@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Destination') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('destination.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {!! Html::decode(Form::label('destination_name',locale_words('Region') . ' ' . locale_words('Name'). '<span class="tooltipim ic" data-toggle="tooltip" title="please enter region engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('destination_name',null,['class'=>'form-control']) !!}
                @error('destination_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order') .'<span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',null,['class'=>'form-control']) !!}
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            <span class="text-primary">search destination location in google map copy address link and paste here</span>--}}
{{--            {!! Html::decode(Form::label('map',locale_words('Map'),['class'=>'control-label col-md-2'])) !!}--}}
{{--            <div class=" col-md-10">--}}
{{--                {!! Form::textarea('map',null,['class'=>'form-control']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            {!! Html::decode(Form::label('image',locale_words('Region') . ' ' . locale_words('Image') .'<span class="tooltipim ic" data-toggle="tooltip" title="choose one image for destination"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control']) !!}
                @error('image')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
