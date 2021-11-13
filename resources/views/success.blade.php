@extends('layouts.app')

@section('content')

    <section class="parallax-window" data-parallax="scroll" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 @if(check_is_mobile()) tour  @else conact  @endif">

        </div>
    </section>
    <div class="banner colored mt-2">
        <div class="">
            <h4 class="m-head2">{{ locale_words('SendSuccess') }}</h4>
        </div>
    </div>

    <div class="container">
        <div class="success-img">
            <img src="{{ asset('content/images/successful-booking.gif') }}"/>
            <div class="container ">
                <div class="row">
                    <div class="col-12 successful-booking">
                        <p>{{ locale_words('WillContact') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection