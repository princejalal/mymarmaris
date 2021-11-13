@extends('adminpanel.layouts.app')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="form-horizontal">
        @if(isset($tour->tour_id))
            <h4>{{ locale_words('Create') }} {{ $dist->district_name }} {{ locale_words('District') }} {{ locale_words('For') }} {{ $tour->tour_name }} {{ locale_words('Tour') }}</h4>
        @else
            <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Tour') }}</h4>
        @endif
        <hr/>
        {!! Form::open(['url' => route('tours.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        @if(isset($tour->tour_id))
            <input type="hidden" name="parent_id" value="{{ $tour->tour_id }}">
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('tour_name',locale_words('Tour') . ' ' . locale_words('Name') .'<span class="tooltipim ic" data-toggle="tooltip" title="please enter tour engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_name',check_property($tour,'tour_name'),['class'=>'form-control','required']) !!}
                @error('tour_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order').'<span class="tooltipim ic" data-toggle="tooltip" title="The order of the tour on the site. The tours are sorted from small to large, according to the sort number."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',check_property($tour,'order'),['class'=>'form-control']) !!}
                @error('order')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="alert alert-info col-md-5 offset-md-2">
                {{ __('message.NotChild') }}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('max_child',locale_words('MaxChild') .  ' ' . locale_words('Age') .'<span class="tooltipim ic" data-toggle="tooltip" title="It is used to determine the age ranges in the tours. When you set the Child age range, the system will automatically determine the baby and adult age ranges. Enter the oldest child age in this section."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('max_child',check_property($tour,'max_child'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('min_child',locale_words('MinChild') .  ' ' . locale_words('Age') .'<span class="tooltipim ic" data-toggle="tooltip" title="It is used to determine the age ranges in the tours. When you set the Child age range, the system will automatically determine the baby and adult age ranges. Enter the smallest child age in this section."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('min_child',check_property($tour,'min_child'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_tag',locale_words('Kind'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('kind',$kinds,check_property($tour,'kind'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">

            {!! Html::decode(Form::label('ShowRecommended',locale_words('ShowRecommended'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="ShowRecommended" type="hidden" value="0">
                {!! Form::checkbox('ShowRecommended',1,null,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('mostPreferred',locale_words('mostPreferred'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="mostPreferred" type="hidden" value="0">
                {!! Form::checkbox('mostPreferred',1,null,['class'=>'']) !!}
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
                {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
