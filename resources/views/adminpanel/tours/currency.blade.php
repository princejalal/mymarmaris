@extends('adminpanel.layouts.app')

@section('content')
    <h4>{{ locale_words('Tour') }} {{ locale_words('Prices') }}</h4>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ __("message.Currency") }}  {{ __('message.Name') }}
            </th>
            <th>{{ locale_words('adults') }}</th>
            @if($tour->min_child != '' && $tour->max_child != '')
                <th>{{ locale_words('child') }} ( {{ $tour->min_child .' - '.   $tour->max_child }} )</th>
                <th>{{ locale_words('infants') }} ( {{ 1 . ' - ' . ($tour->min_child - 1) }} )</th>
            @endif
            <th>{{ locale_words('Passenger') }}</th>
        </tr>
        @foreach($currency as $currenc)
            <tr>
                <td>
                    {{ $currenc->currency_name }}
                </td>
                @foreach($age_range as $range):
                @php
                    $price = \App\Tour_price::where('age_range',$range)->where('currency_id',$currenc->currency_id)->where('tour_id',$TourId)->first();
                @endphp
                @if($price)
                    <td>
                        <form action="{{ route('price.change',$price->price_id) }}" method="POST">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" value="{{ $price->price }}" name="price" required class="form-control"
                                       aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-sm btn-block btn-outline-primary"
                                            type="submit">{{ locale_words('Edit') }}</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-sm btn-block btn-outline-warning" onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('tours.price.destroy',$price->price_id) }}","{{ $price->price_id }}")'>
                                        {{ locale_words('Delete') }}</button>
                                </div>
                            </div>
                        </form>
                    </td>
                @else
                    <td>
                        <form action="{{ route('tours.price.store') }}" method="POST">
                            <input type="hidden" name="tour_id" value="{{ $TourId }}">
                            <input type="hidden" name="currency_id" value="{{ $currenc->currency_id }}">
                            <input type="hidden" name="age_range" value="{{ $range }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" value="" required name="price" class="form-control"
                                       aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <button class="btn btn-sm btn-block btn-outline-danger"
                                    type="submit">{{ locale_words('Save') }}</button>
                        </form>
                    </td>
                @endif

                @endforeach
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
