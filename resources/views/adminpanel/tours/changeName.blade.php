@extends('adminpanel.layouts.app')

@section('content')

    <h4>{{ locale_words('Tour') }} {{ locale_words('Prices') }}</h4>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Destination') }} {{ locale_words('Name') }}
            </th>
            <th>{{ locale_words('Header') }}</th>
            <th>{{ locale_words('Explanations') }}</th>
        </tr>
        @foreach($destinations as $dest)
            <tr>
                <td>
                    {{ $dest->destination_name }}
                </td>
                @php
                    $tourInfo = \App\Tour::where('destination_id',$dest->destination_id)->where('lng_id',$lngId)->where('parent_id',$tour->tour_id)->first();
                    $info = new \stdClass();
                @endphp
                @if($tourInfo)
                    <form action="{{ route('tours.update',$tourInfo->tour_id) }}" method="POST">
                        @php $info = $tourInfo  @endphp
                        {{ method_field('PUT') }}
                     @else
                            <form action="{{ route('tours.store') }}" method="POST">
                     @endif
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $tour->tour_id }}">
                                <input type="hidden" name="lng_id" value="{{ $lngId }}">
                                <input type="hidden" name="destination_id" value="{{ $dest->destination_id }}">
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" name="tour_name" value="{{ check_property($info,'tour_name') }}" required class="form-control"
                                               aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                <textarea name="tour_summary" id="tour_summary" cols="50" rows="3">
                                        {{ check_property($info,'tour_summary') }}
                                </textarea>
                                    </div>
                                </td>
                                <td>
                                    @if($tourInfo)
                                    <button class="btn btn-sm btn-block btn-outline-success"
                                            type="submit">{{ locale_words('Edit') }}</button>
                                        @else
                                        <button class="btn btn-sm btn-block btn-outline-primary"
                                                type="submit">{{ locale_words('Save') }}</button>
                                    @endif
                                </td>
                            </form>
            </tr>
            @endforeach
        </tbody>
    </table>



@endsection
