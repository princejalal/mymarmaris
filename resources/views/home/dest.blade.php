@extends('layouts.app')
@section('content')
    <img src="{{ asset('content/images/Destinations/big/'. $destInfo->image) }}" class="dest-img d-none d-sm-block"/>
    <h1 class="m-head2">{{ $destinationInfo->header }}</h1>
    <div class="container my-bg">
        <div class="row">
            <div class="col-sm-12 my-1">
                <div class="dest-info">
                    <h2 class="text-center">{{ check_property($destinationInfo,'destination_name') }}</h2>
                    <div class="bolum h6 mb-1">
                        <span class="text-success text-bold">{{ (__('message.DestGeneral')) }} : </span> {{ check_property($destinationInfo,'info_text') }}
                    </div>
                    <div class="bolum h6 mb-1">
                        <span class="text-success text-bold">{{ (__('message.BestHotel')) }} : </span> {{ check_property($destinationInfo,'best_hotels') }}
                    </div>
                    <div class="bolum h6 mb-1">
                        <span class="text-success text-bold">{{ (__('message.FamousBeaches')) }} : </span> {{ check_property($destinationInfo,'famous_beaches') }}
                    </div>
                    <div class="bolum h6 mb-1">
                        <span class="text-success text-bold">{{ (__('message.ShoppingCenters')) }} : </span> {{ check_property($destinationInfo,'shoping_center') }}
                    </div>
                </div>
                <hr>
                @if(!check_is_mobile())
                    <div class="dest-info site-content">
                        {!! change_img_class_and_src(check_property($destinationInfo,'content')) !!}
                    </div>
                    <div class="dest-info site-content">
                        {!! change_img_class_and_src(check_property($destinationInfo,'description')) !!}
                    </div>
                @endif
            </div>
            <div class="col-sm-12 my-3 dest-info">
                <div class="row">
                    @foreach($tours as $tour)
                        <div class="col-sm-4 bb mb-3">
                            <a class="cardLink" href="{!! route('item.show',[app()->getLocale(),changeUrlStyle($tour->url)])  !!}">
                                <div id="{{ $tour->tour_id }}" class="card mycard">
                                    <div class="etiket-sarici">
                                        <ul id="e{{ $tour->tour_id }}" class="etiket">
                                            <li>{{ $tour->tag_name }}</li>
                                        </ul>
                                    </div>
                                    <img id="r{{ $tour->tour_id }}" class="card-img-top gif lazy"
                                         data-src="{{ asset('content/images/Tours/' . $tour->parent_id . '/' . $tour->photo_path) }}"
                                         src="{{ asset('content/images/logo.png') }}"
                                         alt="{{ $tour->tour_name }}">
                                    <div class="twoline">
                                        <div class="headsr">
                                            <h3 class="card-title">{{ $tour->tour_name }}</h3>
                                        </div>
                                    </div>

                                    <input type="hidden" id="h{{ $tour->tour_id }}"
                                           value="{{ asset('content/images/Tours/' . $tour->parent_id . '/' . $tour->gif) }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $tour->tour_summary }}</p>
                                        <div class="float-right btn-secondary btn">{{ locale_words('Details') }}</div>
                                        <div class="float-left card-price">
                                            <span>{{ locale_words('Price') }}: </span>{{ $tour->price }}{{ getCurrencyIcon($tour->currency_id) }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @if(check_is_mobile())
                <div class="dest-info site-content px-3">
                    {!! change_img_class_and_src(check_property($destinationInfo,'content')) !!}
                </div>
                <div class="dest-info site-content px-3">
                    {!! change_img_class_and_src(check_property($destinationInfo,'description')) !!}
                </div>
            @endif
        </div>
    </div>
@endsection
