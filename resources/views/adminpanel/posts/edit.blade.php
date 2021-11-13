@extends('adminpanel.layouts.app')


@section('content')
    <div class="form-horizontal">
        {!! Form::open(['url' => route('post.update',$post->message_id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('name',__('message.Name') ,['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('name',$post->name,['class'=>'form-control']) !!}
                @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('email',__(('message.Email')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('email',$post->email,['class'=>'form-control']) !!}
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('phone',__(('message.Phone')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('phone',$post->phone,['class'=>'form-control']) !!}
                @error('phone')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('message',__(('message.Message')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('message',$post->message,['class'=>'form-control','rows',3]) !!}
                @error('message')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="{{ __('message.Edit') }}" class="btn btn-default"/>
            </div>
        </div>
    </div>

@endsection
