@extends('adminpanel.layouts.app')

@section('content')

    <h4>{{ __('message.Show') }} {{ $tour->tour_name }} {{ locale_words('Tours') }} {{ locale_words('Languages') }}</h4>
    <div class="p-3 mb-2 bg-danger text-white">
        {{ locale_words('IfNotLang') }}<a class="text-primary"
                                          href="/adminpanel/languages">here</a>
    </div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Languages') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Has') }} {{ locale_words('Languages') }}<span class="tooltipim" data-toggle="tooltip"
                                                                               title=""
                                                                               data-original-title="if checked icon the destination has language information other one it hasn't"><i
                            class="fa fa-question-circle"></i></span>
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($languages as $lang)
            @foreach($tourInfo as $info)
                @if($lang->lang_id == $info->lang_id)
                    @php $infoId = $info->info_id @endphp
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
                        <a class="btn btn-outline-success"
                           href="{{ route('tourInfo.store',[$tour->tour_id,$lang->lang_id]) }}">{{ locale_words('Edit') }}</a></span>
                        <button class="btn btn-outline-danger"
                                onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('tour.info.destroy',$infoId) }}","{{ $infoId }}")'
                        >{{ __('message.Delete') }}</button>
                    @else
                        <a class="text-warning"
                           href="{{ route('tourInfo.store',[$tour->tour_id,$lang->lang_id]) }}">{{ locale_words('Add') }}</a></span>
                    @endif

                </td>
                @if($lang->haslang == 1)
                    <td>
                        <a class="btn btn-outline-success"
                           href="{{ route('tours.destition.name',[$tour->tour_id,$lang->lang_id]) }}"> {{ locale_words('ChangeNameForDest') }} {{ $lang->lang_name }}</a>
                    </td>
                @endif

            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
