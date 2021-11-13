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
        @if(isset($destInfo->destination_id) && $destInfo->destination_id == $destId)
            <h4>{{ locale_words('Edit') }} {{ $destInfo->destination_name }} {{ locale_words('Language') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('dest.info.update',$destId),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>{{ locale_words('Add') }} {{ locale_words('New') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('dest.info.create',$destId),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="destination_id" value="{{ $destId }}">
        @endif
        <input type="hidden" name="lang_id" value="{{ $language->lang_id }}">
        <div class="form-group">
            {!! Html::decode(Form::label('destination_name',$language->lang_eng_name. ' ' . locale_words('Name'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('destination_name',check_property($destInfo,'destination_name'),['class'=>'form-control','required']) !!}
                @error('destination_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('url', $language->lang_eng_name.' ' . locale_words('Url'),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('url',check_property($destInfo,'url') ,['class'=>'form-control','required']) !!}
                @error('url')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('header',$language->lang_eng_name.' header ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('header',check_property($destInfo,'header'),['class'=>'form-control','required']) !!}
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
                {!! Form::text('menu_header',check_property($destInfo,'menu_header'),['class'=>'form-control','required']) !!}
                @error('menu_header')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('best_hotels',$language->lang_eng_name.' Top Hotels ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('best_hotels',check_property($destInfo,'best_hotels'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('best_hotels')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{--        <div class="form-group">--}}
        {{--            {!! Html::decode(Form::label('antalya_distance_center',$language->lang_eng_name.' Distance to center of Antalya',['class'=>'control-label col-md-2'])) !!}--}}
        {{--            <div class=" col-md-10">--}}
        {{--                {!! Form::textarea('antalya_distance_center',check_property($destInfo,'antalya_distance_center'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}--}}
        {{--                @error('antalya_distance_center')--}}
        {{--                <span class="invalid-feedback text-danger" role="alert">--}}
        {{--                        <strong>{{ $message }}</strong>--}}
        {{--                    </span>--}}
        {{--                @enderror--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="form-group">--}}
        {{--            {!! Html::decode(Form::label('population',$language->lang_eng_name.' population',['class'=>'control-label col-md-2'])) !!}--}}
        {{--            <div class=" col-md-10">--}}
        {{--                {!! Form::textarea('population',check_property($destInfo,'population'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}--}}
        {{--                @error('population')--}}
        {{--                <span class="invalid-feedback text-danger" role="alert">--}}
        {{--                        <strong>{{ $message }}</strong>--}}
        {{--                    </span>--}}
        {{--                @enderror--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="form-group">
            {!! Html::decode(Form::label('nearby_place',$language->lang_eng_name.' nearby place',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('nearby_place',check_property($destInfo,'nearby_place'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('nearby_place')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('famous_beaches',$language->lang_eng_name.' famous beaches',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('famous_beaches',check_property($destInfo,'famous_beaches'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('famous_beaches')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('shoping_center',$language->lang_eng_name.' shoping center',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('shoping_center',check_property($destInfo,'shoping_center'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('shoping_center')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('info_text',$language->lang_eng_name.' general information ',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('info_text',check_property($destInfo,'info_text'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}
                @error('info_text')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('content',$language->lang_eng_name.' content',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('content',check_property($destInfo,'content'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('content')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('descripation',$language->lang_eng_name.' content2',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('descripation',check_property($destInfo,'descripation'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('descripation')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('title',$language->lang_eng_name.' Title',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('title',check_property($destInfo,'title'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {!! Html::decode(Form::label('meta_desc',$language->lang_eng_name.' Meta desciription',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_desc',check_property($destInfo,'meta_desc'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('meta_desc')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_tags',$language->lang_eng_name.' Keywords',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_tags',check_property($destInfo,'meta_tags'),['class'=>'form-control text-box multi-line keyjs','rows'=>2]) !!}
                @error('meta_tags')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($destInfo->destination_id) && $destInfo->destination_id == $destId)
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
