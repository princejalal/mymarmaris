@extends('adminpanel.layouts.app')


@section('content')
    <p>
        <a href="{{ route('tours.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }}</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Tour') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Tour') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Order') }}
            </th>
            <th>
                {{ locale_words('status') }}
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($tours as $tour)
            <tr>
                <td>
                    {{ $tour->tour_id }}
                </td>
                <td>
                    {{ $tour->tour_name }}
                </td>
                <td>
                    {{ $tour->order }}
                </td>
                <td>
                    <a href="{{ route('tours.state',$tour->tour_id) }}">
                        {!! ($tour->publish == 1)? 'active':'deactive'; !!}
                    </a>
                    <span class="tooltipim" data-toggle="tooltip" title=""
                          data-original-title="for active or deactive Destination click on active or deactive"><i
                            class="fa fa-question-circle"></i></span>
                </td>
                <td width="500px" class="disabled">
                    <a class="text-success" href="{{ route('tours.show',$tour->tour_id) }}">
                        {{ locale_words('Tour') }} {{ locale_words('Content') }}</a></span> |
                    @if($tour->parent_id == 0)
                        <a class="text-success" href="{{ route('tours.show.program',$tour->tour_id) }}">
                            {{ locale_words('Tour') }} {{ locale_words('Program') }}</a></span> |
                        <a class="text-purple" href="{{ route('tours.show.photo',$tour->tour_id) }}">
                            Photos
                        </a></span> |
                    @endif
                    <br>
                    <a class="text-success"
                       href="{{ route('tours.edit',$tour->tour_id) }}">{{ locale_words('Edit') }}</a></span> |
                         |
                    <a class="text-danger"
                       href="{{ route('tours.price.index',$tour->tour_id) }}">{{ locale_words('Tour') }} {{ locale_words('Prices') }} </a>
                </td>
                <td>
                    <button class="btn btn-outline-danger" onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('tours.destroy',$tour->tour_id) }}","{{ $tour->tour_id }}")'
                       href="{{ route('tours.destroy',$tour->tour_id) }}">{{ locale_words('Delete') }} </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $tours->links() }}
@endsection
