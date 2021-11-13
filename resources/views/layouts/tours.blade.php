@php($c=1)
@foreach($tours as $tour)
    <div class="col-sm-4 bb mb-4">
        <a class="cardLink" href="{!! route('item.show',[app()->getLocale(),changeUrlStyle($tour->url)])  !!}">
            <div id="{{ $tour->tour_id }}" class="card mycard">
                <img id="r{{ $tour->tour_id }}" class="card-img-top gif lazy"
                     data-src="{{ asset('content/images/Tours/' . $tour->tour_id . '/' . $tour->photo_path) }}"
                     src="{{ asset('content/images/logo.png') }}"
                     alt="{{ $tour->header }}">
                <div class="twoline">
                    <div class="headsr">
                        <h3 class="card-title"><span>{{ $c .'. ' }}</span>{{ $tour->tour_header }}</h3>
                    </div>
                </div>
                <input type="hidden" id="h{{ $tour->tour_id }}"
                       value="{{ asset('content/images/Tours/' . $tour->tour_id . '/' . $tour->gif) }}">
                <div class="card-body">
                    <p class="card-text">{{ $tour->tour_explain }}</p>
                    <div class="float-right btn-secondary btn">{{ locale_words('Details') }}</div>
                    <div class="float-left card-price">
                        <span>{{ locale_words('Price') }}: </span>{{ $tour->price }}{{ getCurrencyIcon($tour->currency_id) }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    @php($c++)
@endforeach
