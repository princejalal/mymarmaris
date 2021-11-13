@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ __('message.Create') }} {{ __('message.New') }} {{ __('message.Tag') }}</h4>
        <hr/>
        @if(isset($lang))
            {!! Form::open(['url' => route('tags.store'),'method'=>'POST']) !!}
            <input type="hidden" value="{{ check_property($parent,'tag_id') }}" name="parent">
            <div class="form-group">
                {!! Html::decode(Form::label('lang_id',__('message.Language') ,['class'=>'control-label col-md-2'])) !!}
                <div class=" col-md-10">
                    {!! Form::select('lang_id',$lang,check_property($tag,'lang_id'),['class'=>'form-control']) !!}
                </div>
            </div>
        @else
            {!! Form::open(['url' => route('tags.store'),'method'=>'POST']) !!}
            <input type="hidden" value="{{ $lang_id }}" name="lang_id">
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('tag_name',__('message.TagName') ,['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tag_name',check_property($tag,'tag_name'),['class'=>'form-control']) !!}
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
