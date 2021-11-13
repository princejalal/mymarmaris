@extends('adminpanel.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/jquery.tagsinput.css') }}">
@endsection

@section('script')
    <script src="{{ asset('admin/js/jquery.tagsinput.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.keyjs').tagsInput({
                width: 'auto',
                'defaultText': 'Only add seo words separated with comma'
            });
        });
    </script>
    @endsection
@section('content')
    <div class="form-horizontal">
        <h3>{{ locale_words('Edit') }} {{ locale_words('Site') }} {{ locale_words('Meta') }} {{ locale_words('Tags') }}</h3>
        <hr/>
        {!! Form::open(['url' => route('metas.update',$siteInfo->id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('site_name',locale_words('Site') .' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('site_name',$siteInfo->site_name,['class'=>'form-control','rows'=>8]) !!}
                @error('site_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('phone',locale_words('Phone'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('phone',$siteInfo->phone,['class'=>'form-control','rows'=>8]) !!}
                @error('phone')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_desc', locale_words('Meta').' ' . locale_words('Description'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('meta_desc',$siteInfo->meta_desc,['class'=>'form-control','rows'=>8]) !!}
                @error('meta_desc')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('email',locale_words('Site') .' ' . locale_words('Email'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('email',$siteInfo->email,['class'=>'form-control','rows'=>8]) !!}
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_tags',locale_words('Meta') . ' ' . locale_words('Tags'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_tags',$siteInfo->meta_tags,['class'=>'form-control','rows'=>8]) !!}
                @error('meta_tags')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('keywords',locale_words('MetaKeywords') .'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="keywords for search engine motors"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('keywords',$siteInfo->keywords,['class'=>'form-control text-box multi-line keyjs','rows'=>2]) !!}
                @error('keywords')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
