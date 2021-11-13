<div class="col-sm-4 order-sm-3 px-0 px-sm-3">
    <div class="s-head my-0">
        <div class="m-0">{{ locale_words('MakeReserve') }}</div>
        <small>{{ locale_words('ConfirmEmail') }}</small>
    </div>
    <div class="form-container">
        {!! Form::open(['url' => route('reserve.store',app()->getLocale()),'method'=>'POST']) !!}
        <input type="hidden" value="{{ $tourInfo->tour_id }}" name="tour_id">
        <input type="hidden" value="{{ \Request::ip() }}" name="ip_address">
        <input type="hidden" value="{{ app()->getLocale() }}" name="user_lang">
        <div class="form-row">
            <div class="form-group col-md-6">
                {!! Html::decode(Form::label('name',__('message.YourName'))) !!}
                {!! Form::text('name',null,['class'=>'form-control','required']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Html::decode(Form::label('email',__('message.YourEmail'))) !!}
                {!! Form::text('email',null,['class'=>'form-control','required']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Html::decode(Form::label('phone',__('message.YourPhone'))) !!}
                {!! Form::text('phone',null,['class'=>'form-control','required']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Html::decode(Form::label('tour_date',__('message.TourDate'))) !!}
                {!! Form::date('tour_date',null,['class'=>'form-control','required','id'=>'resdate']) !!}
            </div>
            <div class="form-group col-md-8">
                {!! Html::decode(Form::label('pick_up_place',__('message.PlacePick'))) !!}
                {!! Form::text('pick_up_place',null,['class'=>'form-control','required','id'=>'respickupplace']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Html::decode(Form::label('room_number',__('message.RoomNumber'))) !!}
                {!! Form::text('room_number',null,['class'=>'form-control','required']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Html::decode(Form::label('adult',__('message.Adult'))) !!}
                {!! Form::number('adult',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Html::decode(Form::label('child',__('message.child'))) !!}
                {!! Form::number('child',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Html::decode(Form::label('infant',__('message.infants'))) !!}
                {!! Form::number('infant',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Html::decode(Form::label('message',__('message.YourMessage'))) !!}
                {!! Form::textarea('message',null,['class'=>'form-control','required','rows'=>2]) !!}
            </div>
            <div class="form-group col-md-12 mt-2">
                <div id="rec"></div>
                @error('g-recaptcha-response')
                <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
        </div>
        <div class="mr-0 text-right">
            <button type="submit" class="btn btn-secondary btn-block">
                {{ __('message.MakeReservition') }}
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>