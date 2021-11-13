@extends('adminpanel.layouts.app')

@section('content')

    <h4>show {{ $district->district_name }} district languages</h4>
    <div class="p-3 mb-2 bg-danger text-white">
        If the language you need is not in the list you can add or active languages <a class="text-primary"
                                                                                       href="/adminpanel/languages">here</a>
    </div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ __('message.Language') }} {{ __('message.Name') }}
            </th>
            <th>
                {{ __('message.Has') }} {{ __('message.Language') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                  data-original-title="if checked icon the destination has language information other one it hasn't"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>{{ __('message.Operations') }}  </th>
        </tr>
        @foreach($languages as $lang)
            @foreach($distirict_info as $info)
                @if($lang->lang_id == $info->lang_id)
                   @php $destInfoId = $info->district_info_id; @endphp
                @endif
            @endforeach
            <tr>
                <td>
                    {{ $lang->lang_name }}
                </td>
                <td>
                    @php ($lang->haslang == 1)? $class = 'fa-check text-success': $class='fa-close text-danger' @endphp
                    <i class="fa {{ $class }}"></i>
                </td>
                <td width="500px" class="disabled">
                    @if($lang->haslang == 1)
                        <a class="text-success"
                           href="{{ route('distInfo.store',[$district->district_id,$lang->lang_id]) }}">{{ __('message.Edit') }}</a></span>
                        |
                        <a class="text-danger pointer-event"
                                onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('distInfo.destroy',$destInfoId) }}","{{ $destInfoId }}")'
                        >{{ __('message.Delete') }}</a>
                    @else
                        <a class="text-warning"
                           href="{{ route('distInfo.store',[$district->district_id,$lang->lang_id]) }}">{{ __('message.Add') }}</a></span>
                    @endif

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
