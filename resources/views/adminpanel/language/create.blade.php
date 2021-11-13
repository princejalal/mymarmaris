@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create')  }} {{ locale_words('Name') }} {{ locale_words('Language') }}</h4>
        <hr/>
        {!! Form::open(['url' => route('languages.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {!! Html::decode(Form::label('lang_name',locale_words('Language') . ' ' . locale_words('Name').'<span class="tooltipim ic" data-toggle="tooltip" title="please enter language engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('lang_name',null,['class'=>'form-control']) !!}
                @error('lang_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('lang_eng_name',locale_words('Engilish') . ' ' . locale_words('Language') . ' ' . locale_words('Name') .'<span class="tooltipim ic" data-toggle="tooltip" title="please enter language engilish name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('lang_eng_name',null,['class'=>'form-control']) !!}
                @error('lang_eng_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('lang_short_name',locale_words('Short') . ' ' . locale_words('Name') .'<span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('lang_short_name',null,['class'=>'form-control']) !!}
                @error('lang_short_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('currency_id',locale_words('Default') . ' ' . locale_words('Currency') .'<span class="tooltipim ic" data-toggle="tooltip" title=""><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('currency_id',$currences,1,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('flag',locale_words('Flag').'<span class="tooltipim ic" data-toggle="tooltip" title="choose flag for langauge"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('flag',null,['class'=>'form-control']) !!}
                @error('flag')
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
