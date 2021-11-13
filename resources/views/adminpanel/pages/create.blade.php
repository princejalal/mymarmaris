@extends('adminpanel.layouts.app')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Page') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('pages.store'),'method'=>'POST']) !!}
        <div class="form-group">
            {!! Html::decode(Form::label('page_name',locale_words('PageName'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('page_name',null,['class'=>'form-control','required']) !!}
                @error('page_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',null,['class'=>'form-control']) !!}
                @error('order')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('kind',locale_words('Kind'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('kind',$pageKind,null,['class'=>'form-control']) !!}
                @error('kind')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('MainMenu',locale_words('ShowOnMainMenu'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="MainMenu" type="hidden" value="0">
                {!! Form::checkbox('MainMenu',1,null,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('showFooter',locale_words('ShowOnFooter'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="showFooter" type="hidden" value="0">
                {!! Form::checkbox('showFooter',1,null,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('showRightPage',locale_words('ShowOnPagesRight'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="showRightPage" type="hidden" value="0">
                {!! Form::checkbox('showRightPage',1,null,['class'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit(locale_words('save'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
