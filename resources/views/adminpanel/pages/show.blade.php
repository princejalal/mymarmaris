@extends('adminpanel.layouts.app')

@section('content')

    <h4>{{ locale_words('Show') }} {{ $page->page_name }} {{ locale_words('Languages') }}</h4>
    <div class="p-3 mb-2 bg-danger text-white">
        {{ locale_words('IfNotlang') }} <a class="text-primary" href="/adminpanel/languages">here</a>
    </div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Language') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Has') }} {{ locale_words('Language') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                  data-original-title="if checked icon the page has language information other one it hasn't"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($languages as $lang)


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
                           href="{{ route('pages.create.info',[$page->page_id,$lang->lang_id]) }}">{{ locale_words('Edit') }}</a></span>
                        |
                        <a class="text-danger"
                           href="{{ route('pages.destroy.info',$page->page_id) }}">{{ locale_words('Delete') }}</a>
                    @else
                        <a class="text-warning"
                           href="{{ route('pages.create.info',[$page->page_id,$lang->lang_id]) }}">{{ locale_words('Add') }}</a></span>
                    @endif

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
