@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style/slider/tour-slider.css') }}">
    <link href="{{ asset('js/BootstrapDateTimePicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
@endsection
@section('js')
    <script defer src="{{ asset('js/tour.js') }}"></script>
    <script defer src="{{ asset('js/BootstrapDateTimePicker/js/bootstrap-datepicker.min.js') }}"></script>
    @include('tour.script')
@endsection

@section('content')
    <div class="tour-head">
        <h1 class="h3" id="tourname">{{ $tourInfo->tour_header }}</h1>
        <p class="h6">{{ $tourInfo->tour_explain }}</p>
    </div>
    <div class="container">
        @include('tour.price')
    </div>
    <div class="@if(!check_is_mobile()) container @endif">
        <div class="row onetur my-bg mb-sm-auto mb-3">
            <div class="col-sm-8 order-sm-2 slider-container">
                @if(!check_is_mobile())
                    @include('tour.slide',['tourPhoto'=>$tourPhoto])
                    @include('tour.diff')
                @endif
            </div>
            <div class="col-sm-4 order-sm-5">
                <div class="row">
                    @include('tour.special')
                    @include('tour.program')
                    @if(check_is_mobile())
                        @include('tour.slide',['tourPhoto'=>$tourPhoto])
                        @include('tour.diff')
                        @include('tour.reseve')
                    @endif
                </div>
            </div>
            @if(!check_is_mobile())
                @include('tour.reseve')
            @endif
            <div class="col-sm-8 order-sm-4 mt-3 ">
                @include('tour.explation')
            </div>
        </div>
    </div>
@endsection


