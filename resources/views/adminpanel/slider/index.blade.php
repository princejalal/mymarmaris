@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a href="{{ route('slider.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }} </a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Slider') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Slider') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Image') }}
            </th>
            <th>{{ locale_words('status') }} </th>
            <th> {{ locale_words('Operations') }} </th>
        </tr>
        @foreach($sliders as $slider)
            <tr>
                <td>
                    {{ $slider->slider_id }}
                </td>
                <td>
                    {{ $slider->slider_name }}
                </td>
                <td>
                    <img src="{{ asset('content/images/slider/' . $slider->image) }}" width="200" height="150">
                </td>
                <td>
                    <a href="{{ route('slider.change',$slider->slider_id) }}">
                        {!! ($slider->publish == 1)? 'active':'deactive'; !!}
                    </a>
                </td>
                <td width="500px">
                    <a class="btn btn-outline-success"
                       href="{{ route('slider.edit',$slider->slider_id) }}">{{ locale_words('Edit') }}</a>
                    <button class="btn btn-outline-danger"
                              onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('slider.destroy',$slider->slider_id) }}","{{ $slider->slider_id }}")'>{{ __('message.Delete') }}</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
