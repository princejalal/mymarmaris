@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Edit') }} {{ $user->name }}</h4>
        <hr/>
            {!! Form::open(['url' => route('manageUser.update',$user->id),'method'=>'POST']) !!}
            {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('name',locale_words('User') . ' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('name',check_property($user,'name'),['class'=>'form-control']) !!}
                @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('email',locale_words('User') . ' ' . locale_words('Email'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('email',check_property($user,'email'),['class'=>'form-control']) !!}
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('user_role',locale_words('Role'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('user_role',['Admin'=>'Admin','User'=>'User'],check_property($user,'user_role'),['class'=>'form-control']) !!}
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
