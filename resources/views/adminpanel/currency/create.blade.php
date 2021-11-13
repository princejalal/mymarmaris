@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Currency') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('currency.store'),'method'=>'POST']) !!}
        <div class="form-group">
            {!! Html::decode(Form::label('currency_name','Currency Name ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('currency_name',null,['class'=>'form-control']) !!}
                @error('currency_id')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('country','Country ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('country',null,['class'=>'form-control']) !!}
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
                {!! Form::text('currency_icon',null,['class'=>'form-control']) !!}
                @error('currency_icon')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="alert alert-info">
            Curreny Icons For Diffrent currency
            <li><span>For Dollar: </span> <span class="text-danger">fas fa-dollar-sign</span></li>
            <li><span>For Lira:</span> <span class="text-danger">fas fa-lira-sign</span></li>
            <li><span>For Euro:</span> <span class="text-danger">fas fa-euro-sign</span></li>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
