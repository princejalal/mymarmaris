@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4> For Tour</h4>
        <hr/>
        {!! Form::open(['url' => route('tours.price.update',$currencyInfo->price_id)]) !!}
        {{ method_field('PUT') }}
        <input type="hidden" name="tour_id" value="{{ $TourId }}">
        <div class="form-group">
            {!! Html::decode(Form::label('currency_id','Currency',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('currency_id',$caurrencies,check_property($currencyInfo,'currency_id'),['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('price','price ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('price',check_property($currencyInfo,'price'),['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('age_range','Age Range <span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('age_range',['adult'=>'adult','child'=>'child','infants'=>'infants'],check_property($currencyInfo,'age_range'),['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                @if(isset($currencyInfo->currency_id) && $currencyInfo->currency_id = $priceId)
                    {!!  Form::submit('edit',['class'=>'btn btn-default']) !!}
                @else
                    {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
