@extends('adminpanel.layouts.app')


@section('content')
    <p>
        <a href="{{ route('destination.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }}</a>
    </p>


    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Destination') }} {{ locale_words('id') }}
            </th>
            <th>
                {{ locale_words('Destination') }} {{ locale_words('Name') }}
            </th>
{{--            <th>--}}
{{--                {{ locale_words('Destination') }} {{ locale_words('image') }}<span class="tooltipim" data-toggle="tooltip" title=""--}}
{{--                                         data-original-title="image of destination for show in slider"><i--}}
{{--                        class="fa fa-question-circle"></i></span>--}}
{{--            </th>--}}
            <th>
                {{ locale_words('Order') }}
            </th>
            <th>
                {{ locale_words('status') }}
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($destinations as $destination)
            <tr>
                <td>
                    {{ $destination->destination_id }}
                </td>
                <td>
                    {{ $destination->destination_name }}
                </td>

{{--                <td>--}}
{{--                    <img src="{{ asset('content/images/Destinations/' . $destination->image) }}" width="150" height="50" alt="">--}}
{{--                </td>--}}
                <td>
                    {{ $destination->order }}
                </td>
                <td>
                    <a href="{{ route('destination.state',$destination->destination_id) }}">
                        {!! ($destination->publish == 1)? 'active':'deactive'; !!}
                    </a>
                    <span class="tooltipim" data-toggle="tooltip" title=""
                          data-original-title="for active or deactive Destination click on active or deactive"><i
                            class="fa fa-question-circle"></i></span>
                </td>
                <td width="500px" class="disabled">
                    <a class="text-success" href="{{ route('destination.show',$destination->destination_id) }}">{{ locale_words('Show') }} {{ locale_words('Language') }}</a></span> |
                    <a class="text-success" href="{{ route('destination.edit',$destination->destination_id) }}">{{ locale_words('Edit') }}</a></span> |
                    <a class="text-danger pointer-event"
                       onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('destination.destroy',$destination->destination_id) }}","{{ $destination->destination_id }}")'
                    >{{ __('message.Delete') }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
