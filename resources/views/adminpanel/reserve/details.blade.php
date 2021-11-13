@extends('adminpanel.layouts.app')

@section('content')

    <div>

        <dl class="dl-horizontal">
            <dt>
                {{ __('message.RelatedTour') }}
            </dt>
            <dd>
                {{ $reserv->tour_name }}
            </dd>
            <dt>
                {{ __('message.Name') }}
            </dt>

            <dd>
                {{ $reserv->name }}
            </dd>

            <dt>
                {{ __('message.email') }}
            </dt>

            <dd>
                {{ $reserv->email }}
            </dd>

            <dt>
                {{ __('message.Phone') }}
            </dt>

            <dd>
                {{ $reserv->phone }}
            </dd>

            <dt>
                {{ __('message.TourDate') }}
            </dt>

            <dd>
                {{ $reserv->tour_date }}
            </dd>

            <dt>
                {{ __('message.PlacePick') }}
            </dt>
            <dd>
                {{ $reserv->pick_up_place }}
            </dd>

            <dt>
                {{ __('message.RoomNumber') }}
            </dt>

            <dd>
                {{ $reserv->room_number }}
            </dd>

            <dt>
                {{ __('message.adults') }}
            </dt>

            <dd>
                {{ $reserv->adults }}
            </dd>

            <dt>
                {{ __('message.child') }}
            </dt>

            <dd>
                {{ $reserv->child }}
            </dd>

            <dt>
                {{ __('message.infants') }}
            </dt>

            <dd>
                {{ $reserv->infant }}
            </dd>

            <dt>
                {{ __('message.Message') }}
            </dt>

            <dd>
                {{ $reserv->message }}
            </dd>

            <dt>
                {{ __('message.UserWebLang') }}
            </dt>

            <dd>
                {{ $reserv->user_lang }}
            </dd>

            <dt>
                {{ __('message.ReservationMakingDate') }}
            </dt>

            <dd>
                {{ $reserv->created_at }}
            </dd>

            <dt>
                {{ __('message.IpLocationInformations') }}
            </dt>

            <dd>
                <?php $info = (array) json_decode($ipdat); ?>
                @foreach($info as $key => $value)
                {{ $key }}  : {{ $value }} <br>
                @endforeach
            </dd>


        </dl>
    </div>
    <p>
        <a href="/adminpanel/reservs">{{ __('message.Back') }}</a>
    </p>


@endsection
