@extends('adminpanel.layouts.app')


@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Location') }} {{ locale_words('Info') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('locations.update')]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('latitude',locale_words('Latitude') ,['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('latitude',$locationInfo->latitude,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('longitude',locale_words('Longitude'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('longitude',$locationInfo->longitude,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
