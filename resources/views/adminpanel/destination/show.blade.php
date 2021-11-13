@extends('adminpanel.layouts.app')

@section('content')

    <h4>show {{ $destination->destination_name }} {{ locale_words('Destination') }} {{ locale_words('Language') }}</h4>
    <div class="p-3 mb-2 bg-danger text-white">
        {{ locale_words('IfNotLang') }} <a class="text-primary"
                                           href="/adminpanel/languages">{{ locale_words('Here') }}</a>
    </div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Language') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ __('message.has') }} {{ locale_words('Language') }}<span class="tooltipim" data-toggle="tooltip"
                                                                            title=""
                                                                            data-original-title="if checked icon the destination has language information other one it hasn't"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>{{ __('message.Operations') }}</th>
        </tr>
        @foreach($languages as $lang)
            @foreach($destination_info as $info)
                @if($lang->lang_id == $info->lang_id)
                        @php $destInfoId = $info->lang_id @endphp
                @endif
            @endforeach
            <tr>
                <td>
                    {{ $lang->lang_name }}
                </td>
                <td>
                    @php ($lang->haslang == 1)? $class = 'fa-check text-success': $class='fa-close
                    text-danger' @endphp
                    <i class="fa {{ $class }}"></i>
                </td>
                <td width="500px" class="disabled">
                    @if($lang->haslang == 1)
                        <a class="text-success"
                           href="{{ route('destInfo.store',[$destination->destination_id,$lang->lang_id]) }}">{{ locale_words('Edit') }}</a>
                        |
                        <a class="text-danger pointer-event"
                           onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('distInfo.destroy',$destInfoId) }}","{{ $destInfoId }}")'
                        >{{ __('message.Delete') }}</a>
                    @else
                        <a class="text-warning"
                           href="{{ route('destInfo.store',[$destination->destination_id,$lang->lang_id]) }}">{{ locale_words('Add') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
