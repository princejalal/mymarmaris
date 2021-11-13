@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>Edit Destination</h4>
        <hr/>
        {!! Form::open(['url' => route('destination.update',$destination->destination_id),'files' =>true,'enctype'=>'multipart/form-data']) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('destination_name',locale_words('Region') . ' ' . locale_words('Name') .' <span class="tooltipim ic" data-toggle="tooltip" title="please enter region engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('destination_name',$destination->destination_name,['class'=>'form-control','required']) !!}
                @error('destination_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order') .' <span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',$destination->order,['class'=>'form-control']) !!}
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            <span class="text-primary">search destination location in google map copy address link and paste here</span>--}}
{{--            {!! Html::decode(Form::label('map',locale_words('Map'),['class'=>'control-label col-md-2'])) !!}--}}
{{--            <div class=" col-md-10">--}}
{{--                {!! Form::textarea('map',$destination->map,['class'=>'form-control']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            {!! Html::decode(Form::label('image',locale_words('Region') . ' ' . locale_words('image') .'<span class="tooltipim ic" data-toggle="tooltip" title="choose one image for destination"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control']) !!}
                <img src="{{ asset('content/images/Destinations/' . $destination->image) }}" width="200" height="50" alt="">
                @error('image')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit('update',['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
