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

        @if(isset($tourInfo->tour_id) && $tourInfo->tour_id == $tourId)
            <h4>{{ locale_words('Edit') }} {{ $tourInfo->tour_name }} {{ locale_words('Language') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('tour.info.update',$tourId),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>{{ locale_words('Add') }} {{ locale_words('New') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('tour.info.create',$tourId),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="tour_id" value="{{ $tourId }}">
        @endif
        <input type="hidden" name="lang_id" value="{{ $language->lang_id }}">
        <div class="form-group">
            {!! Html::decode(Form::label('tour_name',$language->lang_eng_name. ' ' . locale_words('Name') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The '.$language->lang_eng_name.' name for tour"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_name',check_property($tourInfo,'tour_name'),['class'=>'form-control','required']) !!}
                @error('tour_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('url', $language->lang_eng_name. ' ' . locale_words('Url') .' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The section that appears in the address line. Url is important for search engine It should be the most important keyword. As much as possible the use of prepositions and conjunctions should be avoided. Only alphanumeric characters should be used. It should NOT be changed once it has been created."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('url',check_property($tourInfo,'url') ,['class'=>'form-control','required']) !!}
                @error('url')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_header',$language->lang_eng_name.' '. locale_words('Header') .'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The title on the tour page. url must include the keyword you specify."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_header',check_property($tourInfo,'tour_header'),['class'=>'form-control','required']) !!}
                @error('tour_header')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_explain',$language->lang_eng_name. ' ' . locale_words('Tour') . ' ' .  locale_words('Explain').'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="It is the text that appears on the main page and on the bottom of all the tours page. This text must contain keywords. There must be a brief summary of the tour."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('tour_explain',check_property($tourInfo,'tour_explain'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('tour_explain')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_difference',$language->lang_eng_name. ' ' . locale_words('Tour') . ' ' .  locale_words('Difference').'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="It is the text that appears on the main page and on the bottom of all the tours page. This text must contain keywords. There must be a brief summary of the tour."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('tour_difference',check_property($tourInfo,'tour_difference'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('tour_difference')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('content',$language->lang_eng_name. ' ' . locale_words('Content').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="The contents of the tour. The average should be 2000 characters. The keyword specified in the url must be present. The number of times this keyword should be repeated will automatically be notified to you on the panel homepage. In addition, each content should give one link to another round. The tour to which the link will be given should be as relevant as possible. The url format should be in the form of (/ en / boat-tour-alanya) when link is given (http://www.ministertours.com/en/boat-tourlaalanya)."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('content',check_property($tourInfo,'content'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('content')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('title',$language->lang_eng_name. ' ' . locale_words('Title').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Title is very important. The title at the top of each result in search engine results. It is also the font that appears on the tab in the browser. It should definitely contain the keyword in the url."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('title',check_property($tourInfo,'title'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('meta_desc',$language->lang_eng_name. ' ' . locale_words('MetaDesciription').'  <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="In the search engine results is the description text found under the title of each result. Because it is limited in length, it should be written carefully. It should include both keywords and effective sentences to attract the attention of the reader. It should definitely contain the keyword in the url."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('meta_desc',check_property($tourInfo,'meta_desc'),['class'=>'form-control text-box multi-line','rows'=>2]) !!}
                @error('meta_desc')
                <span class="invalid-feedback text-danger" rolscrolling_texte="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('cloud_tags',$language->lang_eng_name.' Cloud Keywords <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="On the tour page, the words appear at the bottom of the page. these words should be the most sought-after keywords in the search engines. An average of 8-15 pieces is sufficient."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('cloud_tags',check_property($tourInfo,'cloud_tags'),['class'=>'form-control text-box multi-line keyjs','rows'=>2]) !!}
                @error('cloud_tags')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($tourInfo->tour_id) && $tourInfo->tour_id == $tourId)
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
