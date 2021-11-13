@extends('adminpanel.layouts.app')

@section('content')
    <table class="table table-responsive">
        <tr>
            <th>
                {{ __('message.UserWebLang') }}
            </th>
            <th>
                {{ __('message.TourName') }}
            </th>
            <th>
                {{ __('message.Name') }}
            </th>
            <th>
                {{ __('message.TourDate') }}
            </th>
            <th>
                {{ __('message.adults') }}
            </th>
            <th>
                {{ __('message.child') }}
            </th>
            <th>
                {{ __('message.infants') }}
            </th>

            <th>
                {{ __('message.ReservationMakingDate') }}
            </th>

            <th></th>
        </tr>
        @foreach($reservs as $reserve)
            <tr class="@if($reserve->is_read == 0) yeni @endif">
                <td>
                    {{ $reserve->user_lang }}
                </td>
                <td>
                    {{ $reserve->tour_name }}
                </td>
                <td>
                    {{ $reserve->name }}
                </td>
                <td>
                    {{ str_replace('/','-',$reserve->tour_date) }}
                </td>

                <td>
                    {{ $reserve->adult }}
                </td>
                <td>
                    {{ $reserve->child }}
                </td>
                <td>
                    {{ $reserve->infant }}
                </td>
                <td>
                    {{ change_zone($reserve->created_at)  }}
                </td>
                <td>
                    <a class="text-success" href="{{ route('reservs.edit',$reserve->reserve_id) }}">{{ __('message.Edit') }}</a></span> |
                    <a class="text-danger" href="{{ route('reservs.show.delete',$reserve->reserve_id) }}">{{ __('message.Delete') }} </a> |
                    <a class="text-danger" href="{{ route('reservs.show',$reserve->reserve_id) }}">{{ __('message.Details') }} </a>
                </td>
            </tr>
        @endforeach

    </table>

    {{ $reservs->links() }}

@endsection
