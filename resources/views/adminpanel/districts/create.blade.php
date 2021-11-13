@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('District') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('districts.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {!! Html::decode(Form::label('destination_id',locale_words('Destination'). '<span class="tooltipim ic" data-toggle="tooltip" title="basic menu or submenu"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('destination_id',$dest,0,['class'=>'form-control']) !!}
                @error('destination_id')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('district_name',locale_words('Region') . ' '.locale_words('Name') . '<span class="tooltipim ic" data-toggle="tooltip" title="please enter region engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('district_name',null,['class'=>'form-control','required']) !!}
                @error('district_id')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('order',locale_words('Order') . '<span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('order',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('image',locale_words('Image') . '<span class="tooltipim ic" data-toggle="tooltip" title="choose one image for destination"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control','required']) !!}
                @error('image')
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
