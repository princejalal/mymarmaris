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
        });
    </script>
@endsection


@section('content')
    <div class="form-horizontal">

        @if(isset($blogInfo->blog_id))
            <h4>Edit {{ $blogInfo->title }} Post</h4>
            <hr/>
            {!! Form::open(['url' => route('blogs.update',$blogInfo->blog_id),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>New Blog</h4>
            <hr/>
            {!! Form::open(['url' => route('blogs.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('lang_id','Language',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('lang_id',$lang,check_property($blogInfo,'lang_id'),['class'=>'form-control','required']) !!}
                @error('lang_id')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('title', 'Header',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('title',check_property($blogInfo,'title') ,['class'=>'form-control','required']) !!}
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('summary','Short Explanation',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('summary',check_property($blogInfo,'summary'),['class'=>'form-control','required','rows'=>2]) !!}
                @error('summary')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('content','Content',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('content',check_property($blogInfo,'content'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('content')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('image','Photo',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::file('image',null,['class'=>'form-control']) !!}
                @if(isset($blogInfo->blog_id))
                    <br>
                    <img src="{{ asset('content/images/Blogs/' . $blogInfo->image) }}" width="200" height="200">
                @endif
                @error('image')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($blogInfo->blog_id))
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit('edit',['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
                </div>
            </div>
        @endif
        {!! Form::close() !!}
    </div>
@endsection
