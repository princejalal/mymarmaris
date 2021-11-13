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
                    removeButtons: 'Save,NewPage,Preview,Print,Templates,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Bold,Italic,Underline,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,NumberedList,Outdent,Indent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,BGColor,Maximize,ShowBlocks,About,SimpleLink,Redo,Undo',
                    // contentsLangDirection: "rtl"
                });
            });

        });
    </script>
@endsection


@section('content')
    <div class="form-horizontal">

        @if(isset($program->tour_id) && $program->tour_id == $tourId)
            <h4>{{ locale_words('Edit') }} {{ $program->tour_name }} {{ locale_words('Program') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('tours.update.program',$tourId),'files' =>true,'enctype'=>'multipart/form-data']) !!}
            {{ method_field('PUT') }}
        @else
            <h4>{{ locale_words('Add') }} {{ locale_words('New') }} {{ locale_words('Program') }}</h4>
            <hr/>
            {!! Form::open(['url' => route('tours.store.program',$tourId),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="tour_id" value="{{ $tourId }}">
        @endif
        <input type="hidden" name="lang_id" value="{{ $language->lang_id }}">
        <div class="form-group">
            {!! Html::decode(Form::label('tour_days',$language->lang_eng_name.' ' . locale_words('Tour') .' ' . locale_words('Days').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Enter the days of the tour using a comma. For example (Monday, Wednesday, Friday or Every day)"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_days',check_property($program,'tour_days'),['class'=>'form-control','required']) !!}
                @error('tour_days')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_hours', $language->lang_eng_name.' ' . locale_words('Tour') .' ' . locale_words('Hours').'<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Enter the days of the tour using a comma. For example (Monday, Wednesday, Friday or Every day)"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('tour_hours',check_property($program,'tour_hours') ,['class'=>'form-control','required']) !!}
                @error('tour_hours')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_includes',$language->lang_eng_name. ' ' . locale_words('Tour') .' ' . locale_words('Includes').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Write to the tour with vigül."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('tour_includes',check_property($program,'tour_includes'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}
                @error('tour_includes')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_excludes',$language->lang_eng_name. ' ' . locale_words('Tour') . ' ' . locale_words('Excludes') . '<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Type ura without separating them with a comma."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('tour_excludes',check_property($program,'tour_excludes'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}
                @error('tour_excludes')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('dont_forget',$language->lang_eng_name. ' ' . locale_words('DontForget').' <span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Write the materials that the participant should keep next to the vigule."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('dont_forget',check_property($program,'dont_forget'),['class'=>'form-control text-box multi-line','rows'=>2,'required']) !!}
                @error('dont_forget')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_program',$language->lang_eng_name. ' ' . locale_words('Tour') . ' ' . locale_words('Program') . '<span class="tooltipim ic" data-toggle="tooltip" title="" data-original-title="Create the tour program via the list icon above. Apply the paste from the Word document to the source section."><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('tour_program',check_property($program,'tour_program'),['class'=>'form-control editor text-box multi-line','rows'=>2,'required']) !!}
                @error('tour_program')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(isset($program->tour_id) && $program->tour_id == $tourId)
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
