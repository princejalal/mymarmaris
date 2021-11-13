@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Edit') }} {{ locale_words('District') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('districts.update',$district->district_id),'files' =>true,'enctype'=>'multipart/form-data']) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('destination_id',locale_words('Destination'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('destination_id',$dest,$district->destination_id,['class'=>'form-control']) !!}
                @error('Destination_id')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('district_name',locale_words('District') . ' ' .locale_words('Name') .'<span class="tooltipim ic" data-toggle="tooltip" title="please enter region engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('district_name',$district->district_name,['class'=>'form-control']) !!}
                @error('district_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order').'<span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',$district->order,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('image', locale_words('Image').'<span class="tooltipim ic" data-toggle="tooltip" title="choose one image for destination"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control']) !!}
                <br>
                <img src="{{ asset('content/images/District/' . $district->image) }}" width="200" height="50" alt="">
                @error('image')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit('update',['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
