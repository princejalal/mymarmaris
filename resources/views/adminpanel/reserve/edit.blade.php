@extends('adminpanel.layouts.app')


@section('content')
    <div class="form-horizontal">
        {!! Form::open(['url' => route('reservs.update',$reserv->reserve_id)]) !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            {!! Html::decode(Form::label('name',__('message.Name') ,['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('name',$reserv->name,['class'=>'form-control']) !!}
                @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('email',__(('message.Email')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('email',$reserv->email,['class'=>'form-control']) !!}
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('phone',__(('message.Phone')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('phone',$reserv->phone,['class'=>'form-control']) !!}
                @error('phone')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tour_date',__(('message.TourDate')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::date('tour_date',$reserv->tour_date,['class'=>'form-control','id'=>'TourDate']) !!}
                @error('tour_date')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('pick_up_place',__(('message.PlacePick')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::text('pick_up_place',$reserv->pick_up_place,['class'=>'form-control']) !!}
                @error('pick_up_place')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('room_number',__(('message.RoomNumber')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('room_number',$reserv->room_number,['class'=>'form-control']) !!}
                @error('room_number')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('adult',__(('message.adult')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('adult',$reserv->adult,['class'=>'form-control']) !!}
                @error('adult')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('child',__(('message.child')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('child',$reserv->child,['class'=>'form-control']) !!}
                @error('child')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('infant',__(('message.infants')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::number('infant',$reserv->infant,['class'=>'form-control']) !!}
                @error('infant')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('message',__(('message.Message')),['class'=>'control-label col-md-2'])) !!}
            <div class=" col-md-10">
                {!! Form::textarea('message',$reserv->message,['class'=>'form-control','rows',3]) !!}
                @error('message')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="{{ __('message.Edit') }}" class="btn btn-default"/>
            </div>
        </div>
    </div>

@endsection
