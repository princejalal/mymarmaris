@extends('adminpanel.layouts.app')

@section('content')
    <div class="form-horizontal">
        <h4>{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words("Menu") }}</h4>
        <hr/>
        {!! Form::open(['url' => route('menu.store'),'method'=>'POST']) !!}
        @if($kind == 'submenu')
            <div class="form-group">
                {!! Html::decode(Form::label('submenu',locale_words('Menu') . ' ' . locale_words('Kind').'<span class="tooltipim ic" data-toggle="tooltip" title="basic menu or submenu"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
                <div class=" col-md-10">
                    {!! Form::select('submenu',$basicMenu,0,['class'=>'form-control']) !!}
                </div>
            </div>
        @endif
        <div class="form-group">
            {!! Html::decode(Form::label('menu_name',locale_words('Menu') . ' ' . locale_words('Name').'<span class="tooltipim ic" data-toggle="tooltip" title="the menu name"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('menu_name',null,['class'=>'form-control']) !!}
                @error('menu_name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('menu_icon',locale_words('Icon'). '<span class="tooltipim ic" data-toggle="tooltip" title="icon for show alongside menu can search icon in https://fontawesome.com/"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('menu_icon',null,['class'=>'form-control']) !!}
                @error('menu_icon')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('menu_position',locale_words('Position') . '<span class="tooltipim ic" data-toggle="tooltip" title="position for menu in side bar"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('menu_position',null,['class'=>'form-control']) !!}
                @error('menu_position')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('menu_link',locale_words('Menu') . ' ' . locale_words('Link') .'<span class="tooltipim ic" data-toggle="tooltip" title="link for destination menus"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('menu_link',null,['class'=>'form-control']) !!}
                @error('menu_link')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('menu_permission',locale_words('Permission') . '<span class="tooltipim ic" data-toggle="tooltip" title="permission for users"><i class="fa fa-question-circle"></i></span>',['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::select('menu_permission',[1=>'admin',2=>'blogger',3=>'user'],1,['class'=>'form-control']) !!}
                @error('menu_permission')
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
