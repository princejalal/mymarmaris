@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ __('message.Edit') }} {{ __('message.Tour') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('tours.update',$tour->tour_id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('tour_name',  __('message.TourName'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_name',$tour->tour_name,['class'=>'form-control','required']) !!}
                @error('tour_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order', __('message.TourOrder') ,['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',$tour->order,['class'=>'form-control']) !!}
                @error('order')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('max_child',__('message.MaxChild'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('max_child',$tour->max_child,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('min_child',__('message.MinChild'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('min_child',$tour->min_child,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('kind',locale_words('Kind'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('kind',$kinds,check_property($tour,'kind'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('ShowRecommended',locale_words('ShowRecommended'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="ShowRecommended" type="hidden" value="0">
                {!! Form::checkbox('ShowRecommended',1,$tour->ShowRecommended,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('mostPreferred',locale_words('mostPreferred'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="mostPreferred" type="hidden" value="0">
                {!! Form::checkbox('mostPreferred',1,$tour->mostPreferred,['class'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_tag',locale_words('Tags') .'<span class="tooltipim ic" data-toggle="tooltip" title="It is used to determine the age ranges in the tours. When you set the Child age range, the system will automatically determine the baby and adult age ranges. Enter the smallest child age in this section."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('tour_tag',$tags,check_property($tour,'tour_tag'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit(__('message.Edit'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
