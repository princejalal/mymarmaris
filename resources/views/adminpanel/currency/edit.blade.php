@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>edit currency</h4>
        <hr/>
        {!! Form::open(['url' => route('currency.update',$currency->currency_id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('currency_name','Currency Name ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('currency_name',$currency->currency_name,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('country','Country ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('country',$currency->country,['class'=>'form-control']) !!}
                @error('country')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('currency_icon','Currency Icon ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('currency_icon',$currency->currency_icon,['class'=>'form-control']) !!}
                @error('currency_icon')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
