@extends('adminpanel.layouts.app')

@section('content')

    <h4>{{ __('message.Show') }} {{ $tour->tour_name }} {{ __('message.Program') }}  {{ __('message.Languages') }} Languages</h4>
    <div class="p-3 mb-2 bg-danger text-white">
        {{ __('message.IfNotLang') }} <a class="text-primary" href="/adminpanel/languages">{{ __('message.Here') }}</a>
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
            <th>{{ __('message.Operations') }}</th>
        </tr>
        @foreach($languages as $lang)
            @foreach($tour_program as $info)
                @if($lang->lang_id == $info->lang_id)
                    @php  $progId = $info->program_id  @endphp
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
                           href="{{ route('tours.create.program',[$tour->tour_id,$lang->lang_id]) }}">{{ __('message.Edit') }}</a>
                        |
                        <button class="btn btn-outline-danger"
                                onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('tours.delete.program',$progId) }}","{{ $progId }}")'
                        >{{ __('message.Delete') }}</button>
                    @else
                        <a class="text-warning"
                           href="{{ route('tours.create.program',[$tour->tour_id,$lang->lang_id]) }}">{{ __('message.Add') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
