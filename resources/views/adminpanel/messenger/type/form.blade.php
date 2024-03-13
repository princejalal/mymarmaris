<div class="form-horizontal">
    <h4>New Messenger type</h4>
    <hr/>
    {!! Form::open(['url' => route('messenger-type.store'),'method'=>'POST','files' =>true,'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {!! Html::decode(Form::label('name','name',['class'=>'control-label col-md-2'])) !!}
        <div class=" col-md-10">
            {!! Form::text('name',null,['class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(Form::label('link','Link',['class'=>'control-label col-md-2'])) !!}
        <div class=" col-md-10">
            {!! Form::text('link',null,['class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(Form::label('icon', 'Icon',['class'=>'control-label col-md-2'])) !!}
        <div class=" col-md-10">
            {!! Form::text('icon',null ,['class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-8">
            {!!  Form::submit('save',['class'=>'btn btn-default']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
