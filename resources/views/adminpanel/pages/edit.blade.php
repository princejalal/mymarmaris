@extends('adminpanel.layouts.app')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="form-horizontal">
        <h4>{{locale_words('Edit')}} {{ $page->page_name }} {{ locale_words('Page') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('pages.update',$page->page_id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('page_name',locale_words('PageName'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('page_name',$page->page_name,['class'=>'form-control','required']) !!}
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
                {!! Form::number('order',$page->order,['class'=>'form-control']) !!}
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
                {!! Form::select('kind',$pageKind,$page->kind,['class'=>'form-control']) !!}
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
                {!! Form::checkbox('MainMenu',1,$page->MainMenu,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('showFooter',locale_words('ShowOnFooter'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="showFooter" type="hidden" value="0">
                {!! Form::checkbox('showFooter',1,$page->showFooter,['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('showRightPage',locale_words('ShowOnPagesRight'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="showRightPage" type="hidden" value="0">
                {!! Form::checkbox('showRightPage',1,$page->showRightPage,['class'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit(locale_words('Edit'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
