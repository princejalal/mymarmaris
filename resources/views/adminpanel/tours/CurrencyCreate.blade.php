@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Price') }} {{ locale_words('For') }} {{locale_words('Tour')}}</h4>
        <hr/>
            {!! Form::open(['url' => route('tours.price.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        <input type="hidden" name="tour_id" value="{{ $TourId }}">
        <div class="form-group">
            {!! Html::decode(Form::label('currency_id',locale_words('Price'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('currency_id',$caurrencies,null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('price','price',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('price',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('age_range','Age Range <span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('age_range',['adult'=>'adult','child'=>'child','infants'=>'infants','passenger'=>'passenger'],null,['class'=>'form-control','required']) !!}
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
