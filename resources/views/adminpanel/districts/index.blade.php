@extends('adminpanel.layouts.app')


@section('content')
    <p>
        <a href="{{ route('districts.create') }}">Create new</a>
    </p>


    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('District') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Destination') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('District') }} {{locale_words('Name')}}
            </th>
            <th>
                {{ locale_words('District') }} {{ locale_words('Image') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                       data-original-title="image of destination for show in slider"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>
                {{ locale_words('Order') }}
            </th>
            <th>
                {{ locale_words('status') }}
            </th>
            <th>{{ locale_words('Operations') }}</th>
        </tr>
        @foreach($districts as $district)
            <tr>
                <td>
                    {{ $district->district_id }}
                </td>
                <td>
                    {{ $district->destination_name }}
                </td>
                <td>
                    {{ $district->district_name }}
                </td>
                <td>
                    <img src="{{ asset('content/images/District/' . $district->image) }}" width="150" height="50" alt="">
                </td>
                <td>
                    {{ $district->order }}
                </td>
                <td>
                    <a href="{{ route('district.state',$district->district_id) }}">
                        {!! ($district->publish == 1)? 'active':'deactive'; !!}
                    </a>
                    <span class="tooltipim" data-toggle="tooltip" title=""
                          data-original-title="for active or deactive district click on active or deactive"><i
                            class="fa fa-question-circle"></i></span>
                </td>
                <td width="500px" class="disabled">
                    <a class="text-success" href="{{ route('districts.show',$district->district_id) }}">{{ __('message.Show') }} {{ __('message.Language') }}</a></span> |
                    <a class="text-success" href="{{ route('districts.edit',$district->district_id) }}">{{ __('message.Edit') }}</a></span> |
                    <a class="text-danger"
                            onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('districts.destroy',$district->district_id) }}","{{ $district->district_id }}")'
                    >{{ __('message.Delete') }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $districts->links() }}
@endsection
