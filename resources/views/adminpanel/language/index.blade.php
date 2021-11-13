@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a href="{{ route('languages.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Language') }}</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Language') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Language') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Language') }} {{ locale_words('Short') }} {{ locale_words('Name') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                         data-original-title="The position of menu in side bar"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>
                {{ locale_words('Flag') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                   data-original-title="menu icon from fontawsome icon https://fontawesome.com/"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>{{ locale_words('Publish') }}</th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($languages as $language)
            <tr>
                <td>
                    {{ $language->lang_id }}
                </td>
                <td>
                    {{ $language->lang_name }}
                </td>

                <td>
                    {{ $language->lang_short_name }}
                </td>
                <td>
                    <img src="{{ asset($language->flag) }}" height="50" width="50" alt="">
                </td>
                <td>
                    @if($language->lang_id != 1)
                        <a href="{{ route('language.state',$language->lang_id) }}">
                            {!! ($language->publish == 1)? 'active':'deactive'; !!}
                        </a>
                        <span class="tooltipim" data-toggle="tooltip" title=""
                              data-original-title="for active or deactive language click in text"><i
                                class="fa fa-question-circle"></i></span>

                    @endif
                </td>
                <td width="500px" class="disabled">
                    <a class="btn btn-outline-success"
                       href="{{ route('languages.edit',$language->lang_id) }}">{{ locale_words('Edit') }}</a>
                    @if($language->lang_id != 1)
                        <button class="btn btn-outline-danger"
                                onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('languages.destroy',$language->lang_id) }}","{{ $language->lang_id }}")'>{{ __('message.Delete') }}</button>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
