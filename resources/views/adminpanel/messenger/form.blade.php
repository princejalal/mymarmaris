@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        @if(isset($messenger->id))
            <h4>Edit {{ $messenger->title }} Messenger</h4>
            <hr/>
            {!! Form::open(['url' => route('messenger.update',$messenger->id),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>New Messenger</h4>
            <hr/>
            {!! Form::open(['url' => route('messenger.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('lang_id','Language',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('lang_id',\App\Language::get()->pluck('lang_short_name','lang_id'),check_property($messenger,'lang_id'),['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('type_id','Messenger Type',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('type_id',\App\Messenger_type::get()->pluck('name','id'),check_property($messenger,'type_id'),['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('value', 'Value',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('value',check_property($messenger,'value') ,['class'=>'form-control','required']) !!}
            </div>
        </div>
        @if(isset($messenger->id))
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit('edit',['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @endif
        {!! Form::close() !!}
    </div>
@endsection
