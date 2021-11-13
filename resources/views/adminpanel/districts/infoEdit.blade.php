@extends('adminpanel.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/jquery.tagsinput.css') }}">
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.tagsinput.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('textarea.editor').each(function () {
                var editor = CKEDITOR.instances[this.id];
                if (editor) {
                    editor.destroy(true);
                }
                CKEDITOR.replace(this.id, {
                    language: 'en',
                    {{--customConfig: {{ asset('ckeditor/config.js') }},--}}
                    height: '300px',
                    extraPlugins: "imageuploader,uploadimage,image2",
                    filebrowserUploadUrl: "{{ route('dest.upload',['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    filebrowserImageUploadUrl: "{{ route('dest.upload',['_token' => csrf_token()]) }}",
                    // contentsLangDirection: "rtl"
                });
            });
            $('.keyjs').tagsInput({
                width: 'auto',
                'defaultText': 'Only add seo words separated with comma'
            });
        });
    </script>
@endsection


@section('content')
    <div class="form-horizontal">

        @if(isset($distInfo->district_id) && $distInfo->district_id == $distId)
            <h4>edit {{ $distInfo->district_name }} language</h4>
            <hr/>
            {!! Form::open(['url' => route('dist.info.update',$distId),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>add new</h4>
            <hr/>
            {!! Form::open(['url' => route('dist.info.create',$distId),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="district_id" value="{{ $distId }}">
        @endif
        <input type="hidden" name="lang_id" value="{{ $language->lang_id }}">
        <div class="form-group">
            {!! Html::decode(Form::label('district_name',$language->lang_eng_name.' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('district_name',check_property($distInfo,'district_name'),['class'=>'form-control','required']) !!}
                @error('district_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('url', $language->lang_eng_name.' ' . locale_words('Url'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('url',check_property($distInfo,'url') ,['class'=>'form-control','required']) !!}
                @error('url')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('header',$language->lang_eng_name.' ' . locale_words('Header'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('header',check_property($distInfo,'header'),['class'=>'form-control','required']) !!}
                @error('header')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('menu_header',$language->lang_eng_name.' ' . locale_words('Menu') . ' ' . locale_words('Header'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('menu_header',check_property($distInfo,'menu_header'),['class'=>'form-control','required']) !!}
                @error('menu_header')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('scrolling_text',$language->lang_eng_name.' ' . locale_words('ScrollingText'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('scrolling_text',check_property($distInfo,'scrolling_text'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}
                @error('scrolling_text')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('content',$language->lang_eng_name.' ' . locale_words('Content'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('content',check_property($distInfo,'content'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('content')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('descripation',$language->lang_eng_name.' ' . locale_words('Content2'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('descripation',check_property($distInfo,'descripation'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('descripation')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('title',$language->lang_eng_name.' ' . locale_words('title'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('title',check_property($distInfo,'title'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_desc',$language->lang_eng_name.' ' . locale_words('metaDesc'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_desc',check_property($distInfo,'meta_desc'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('meta_desc')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_tags',$language->lang_eng_name.' ' . locale_words('Keyword'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_tags',check_property($distInfo,'meta_tags'),['class'=>'form-control text-box multi-line keyjs','rows'=>2]) !!}
                @error('meta_tags')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($distInfo->district_id) && $distInfo->district_id == $distId)
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit(locale_words('Edit'),['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit(locale_words('Save'),['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @endif
        {!! Form::close() !!}
    </div>
@endsection
