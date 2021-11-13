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
                    height: '300px',
                    extraPlugins: "imageuploader,uploadimage,image,image2",
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

        @if(isset($pageInfo->page_id) && $pageInfo->page_id == $pageId)
            <h4>Edit {{ $pageInfo->page_name }} language</h4>
            <hr/>
            {!! Form::open(['url' => route('pages.update.info',$page->page_id)]) !!}
            {{ method_field('PUT') }}
        @else
            <h4>{{ locale_words('Add') }} {{ locale_words('New') }} {{ $language->lang_eng_name }} {{ locale_words('Information') }} {{ locale_words('For') }} {{ $page->page_name }} {{ locale_words('Page') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('pages.store.info'),'method'=>'POST']) !!}
        @endif
        <input type="hidden" name="page_id" value="{{ $page->page_id }}">
        <input type="hidden" name="lang_id" value="{{ $language->lang_id }}">
        <div class="form-group">
            {!! Html::decode(Form::label('page_name',$language->lang_eng_name. ' ' . locale_words('Name') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The '.$language->lang_eng_name.' name for page"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('page_name',check_property($pageInfo,'page_name'),['class'=>'form-control','required']) !!}
                @error('page_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('url', $language->lang_eng_name.' ' . locale_words('Url') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The section that appears in the address line. Url is important for search engine It should be the most important keyword. As much as possible the use of prepositions and conjunctions should be avoided. Only alphanumeric characters should be used. It should NOT be changed once it has been created."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('url',check_property($pageInfo,'url') ,['class'=>'form-control','required']) !!}
                @error('url')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('header',$language->lang_eng_name.' ' . locale_words('Header') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The title on the page page. url must include the keyword you specify."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('header',check_property($pageInfo,'header'),['class'=>'form-control','required']) !!}
                @error('header')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            {!! Html::decode(Form::label('scrolling_text',$language->lang_eng_name.' ' . locale_words('ScrollingText') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="On the top of the site is the scrolling text."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}--}}
{{--            <div class=" col-md-10">--}}
{{--                {!! Form::textarea('scrolling_text',check_property($pageInfo,'scrolling_text'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}--}}
{{--                @error('scrolling_text')--}}
{{--                <span class="invalid-feedback text-danger" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            {!! Html::decode(Form::label('content',$language->lang_eng_name.' ' . locale_words('Content') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The contents of the page. The average should be 2000 characters. The keyword specified in the url must be present. The number of times this keyword should be repeated will automatically be notified to you on the panel homepage. In addition, each content should give one link to another round. The page to which the link will be given should be as relevant as possible. The url format should be in the form of (/ en / boat-page-alanya) when link is given (http://www.ministerpages.com/en/boat-pagelaalanya)."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('content',check_property($pageInfo,'content'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('content')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('description',$language->lang_eng_name. ' ' . locale_words('Content2') .'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The contents of the page. The average should be 2000 characters. The keyword specified in the url must be present. The number of times this keyword should be repeated will automatically be notified to you on the panel homepage. In addition, each content should give one link to another round. The page to which the link will be given should be as relevant as possible. The url format should be in the form of (/ en / boat-page-alanya) when link is given (http://www.ministerpages.com/en/boat-pagelaalanya)."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('description',check_property($pageInfo,'description'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('description')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('title',$language->lang_eng_name. ' ' . locale_words('Title').'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Title is very important. The title at the top of each result in search engine results. It is also the font that appears on the tab in the browser. It should definitely contain the keyword in the url."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('title',check_property($pageInfo,'title'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_desc',$language->lang_eng_name. ' '. locale_words('MetaDescription').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="In the search engine results is the description text found under the title of each result. Because it is limited in length, it should be written carefully. It should include both keywords and effective sentences to attract the attention of the reader. It should definitely contain the keyword in the url."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_desc',check_property($pageInfo,'meta_desc'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('meta_desc')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_tags',$language->lang_eng_name. ' ' . locale_words('Keyword').'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="It is used to make it easier for search engines to index the page. All you need to do is to write the keywords related to the page by separating them with commas. 10-20 key words are ideal."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_tags',check_property($pageInfo,'meta_tags'),['class'=>'form-control text-box multi-line keyjs','rows'=>2]) !!}
                @error('meta_tags')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($pageInfo->page_id) && $pageInfo->page_id == $pageId)
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
