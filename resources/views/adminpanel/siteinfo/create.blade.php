@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        @if(isset($contactInfo->contact_id))
            <h3>{{ locale_words('Edit') }} {{ locale_words('Contact') }} {{ locale_words('Information') }}</h3>
            <hr/>
            {!! Form::open(['url' => route('contact.update',$contactInfo->contact_id)]) !!}
            {{ method_field('PUT') }}
        @else
            <h3>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Contact') }} {{ locale_words('Information') }}</h3>
            <hr/>
            {!! Form::open(['url' => route('contact.store'),'method'=>'POST']) !!}
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('name',locale_words('Contact'). ' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('name',check_property($contactInfo,'name'),['class'=>'form-control','rows'=>8]) !!}
                @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('contact_value',locale_words('Value') . ' ' . locale_words('Of') . ' ' . locale_words('Contact'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('contact_value',check_property($contactInfo,'contact_value'),['class'=>'form-control','rows'=>8]) !!}
                @error('contact_value')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('kind',locale_words('Kind') . ' ' . locale_words('Of') . ' ' . locale_words('Contact'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('kind',$kind,check_property($contactInfo,'kind'),['class'=>'form-control']) !!}
                @error('kind')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('showOnTop',locale_words('showOnTop'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="showOnTop" type="hidden" value="0">
                {!! Form::checkbox('showOnTop',1,check_property($contactInfo,'showOnTop'),['class'=>'']) !!}
            </div>
            {!! Html::decode(Form::label('ShowOnFooter',locale_words('ShowOnFooter'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-2">
                <input name="ShowOnFooter" type="hidden" value="0">
                {!! Form::checkbox('ShowOnFooter',1,check_property($contactInfo,'ShowOnFooter'),['class'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('icon',locale_words('Icon') . ' ' . locale_words('Of') . ' ' . locale_words('Contact'),['class'=>'control-label col-md-2','placeholder'=>'Example: fab fa-telegram-plane'])) !!}
            <div class=" col-md-10">
                {!! Form::text('icon',check_property($contactInfo,'icon'),['class'=>'form-control']) !!}
                @error('icon')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('lang_id',locale_words('Language') . ' ' . locale_words('Of') . ' ' . locale_words('Contact'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('lang_id',$langs,check_property($contactInfo,'lang_id'),['class'=>'form-control']) !!}
                @error('lang_id')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                @if(isset($contactInfo->contact_id))
                    {!!  Form::submit(locale_words('Edit'),['class'=>'btn btn-default']) !!}
                @else
                    {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
