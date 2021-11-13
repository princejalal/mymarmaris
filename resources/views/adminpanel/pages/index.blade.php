@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a href="{{ route('pages.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Page') }}</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Page') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Page') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('ShowOnMainMenu') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                       data-original-title="page name show on main menu"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>
                {{ locale_words('ShowOnFooter') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                         data-original-title="page name show in side menu"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>
                {{ locale_words('ShowOnPagesRight') }}<span class="tooltipim" data-toggle="tooltip" title=""
                                          data-original-title="page name show in footer"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>{{ locale_words('status') }}</th>
            <th>{{ locale_words('Operations') }} </th>
        </tr>
        @foreach($pages as $page)
            <tr>
                <td>
                    {{ $page->page_id }}
                </td>
                <td>
                    {{ $page->page_name }}
                </td>
                <td>
                    @php ($page->MainMenu == 1)? $checked = 'checked':$checked = '' @endphp
                    <input {{ $checked }} class="check-box" disabled="disabled" type="checkbox">
                </td>

                <td>
                    @php ($page->showFooter == 1)? $checked = 'checked':$checked = '' @endphp
                    <input {{ $checked }} class="check-box" disabled="disabled" type="checkbox">
                </td>
                <td>
                    @php ($page->showRightPage == 1)? $checked = 'checked':$checked = '' @endphp
                    <input {{ $checked }} class="check-box" disabled="disabled" type="checkbox">
                </td>
                <td>
                    @if($page->page_id > 2 )
                        <a href="{{ route('pages.change.state',$page->page_id) }}">
                            {!! ($page->publish == 1)? 'active':'deactive'; !!}
                        </a>
                        <span class="tooltipim" data-toggle="tooltip" title=""
                              data-original-title="for active or deactive page click in text"><i
                                class="fa fa-question-circle"></i></span>
                    @endif
                </td>
                <td width="500px">
                    @if($page->page_id > 2 )
                        <a class="btn btn-outline-success" href="{{ route('pages.edit',$page->page_id) }}">{{ locale_words('Edit') }}</a>
                        | <button class="btn btn-outline-danger" onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('pages.destroy',$page->page_id) }}","{{ $page->page_id  }}")'
                                  href="{{ route('tours.destroy',$page->page_id) }}">{{ locale_words('Delete') }} </button>
                    @endif
                </td>
                <th>
                    <a href="{{ route('pages.show',$page->page_id) }}">{{ locale_words('Show') }} {{ locale_words('Languages') }}</a>
                </th>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
