@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a href="{{ route('menu.create') }}">{{ locale_words('Create') }} {{ locale_words('Basic') }} {{ locale_words('Menu') }}</a>
        |
        <a href="{{ route('menu.submenu') }}">{{ locale_words('Create') }} {{ locale_words('Submenu') }}</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Menu') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Menu') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Position') }}<span class="tooltipim" data-toggle="tooltip" title=""
                              data-original-title="The position of menu in side bar"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>
                {{ locale_words('Menu') }} {{ locale_words('Icon') }}<span class="tooltipim" data-toggle="tooltip" title=""
                               data-original-title="menu icon from fontawsome icon https://fontawesome.com/"><i
                        class="fa fa-question-circle"></i></span>
            </th>
            <th>{{ locale_words('Publish') }}</th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>
                    {{ $menu->menu_id }}
                </td>
                <td>
                    {{ $menu->menu_name }}
                </td>

                <td>
                    {{ $menu->menu_position }}
                </td>
                <td>
                    <i class="{{ $menu->menu_icon }}"></i>
                </td>
                <td>
                    <a href="{{ route('menu.state',$menu->menu_id) }}">
                    {!! ($menu->publish == 1)? 'active':'deactive'; !!}
                    </a>
                    <span class="tooltipim" data-toggle="tooltip" title=""
                          data-original-title="for active or deactive menu click in text"><i
                            class="fa fa-question-circle"></i></span>
                </td>
                <td width="500px" class="disabled">
                    <a class="text-success" href="{{ route('menu.edit',$menu->menu_id) }}">{{ locale_words('Edit') }}</a><span
                        class="tooltipim" data-placement="left" data-toggle="tooltip" title=""
                        data-original-title="It is the section where the tour program is organized."><i
                            class="fa fa-question-circle"></i></span> |
                    @if($menu->editable == 1)
                        <a class="text-danger pointer-event"
                           onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('menu.destroy',$menu->menu_id) }}","{{ $menu->menu_id }}")'
                        >{{ __('message.Delete') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
