@extends('adminpanel.layouts.app')

@section('content')

    <h4>{{ __('message.Show') }} {{ $tour->tour_name }} {{ __('message.Tours') }} {{ __('message.Districts') }}</h4>
    <div class="p-3 mb-2 bg-danger text-white">
         {{ locale_words('IfNotDist') }}<a class="text-primary" href="/adminpanel/districts">{{ locale_words('Here') }}</a>
    </div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ __('message.Districts') }} {{ __('message.Name') }}
            </th>
            <th>
                {{ __('message.Tour') }} {{ __('message.Has') }} {{ __('message.Districts') }}<span class="tooltipim"
                                                                                                    data-toggle="tooltip"
                                                                                                    title=""
                                                                                                    data-original-title="if checked icon the destination has language information other one it hasn't"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($dists as $district)
            @foreach($tours as $info)
                @if($district->district_id == $info->district_id)
                    @php $infoId = $info->tour_id @endphp
                @endif
            @endforeach
            <tr>
                <td>
                    {{ $district->district_name }}
                </td>
                <td>
                    @php ($district->hasDist == 1)? $class = 'fa-check text-success': $class='fa-close
                    text-danger' @endphp
                    <i class="fa {{ $class }}"></i>
                </td>
                <td width="500px" class="disabled">
                    @if($district->hasDist == 1)
                        <a class="text-success" href="{{ route('tours.show.program',$district->tour_id) }}">
                            Tour Program</a>
                        |
                        <a href="#" class="text-danger"
                                onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('destroy.with.district',$infoId) }}","{{ $infoId }}")'
                        >{{ __('message.Delete') }}</a>
                    @else
                        <a class="text-warning"
                           href="{{ route('create.with.district',[$district->district_id,$tour->tour_id]) }}">{{ __('message.Create') }} {{ __('message.With') }} {{ __('message.District') }}</a>
                    @endif
                </td>

                <td>
                    @if($district->hasDist == 1)
                        <a class="text-success" href="{{ route('tours.show',$district->tour_id) }}">
                            {{ __('message.Tour') }} {{ __('message.Content') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
