@extends('adminpanel.layouts.app')


@section('content')
    <p>
        <a href="{{ route('tags.create') }}">Create new</a>
    </p>


    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Tags') }}
            </th>
            <th>
                {{ locale_words('kind') }}
            </th>
            <th>{{ locale_words('Operations') }} </th>
        </tr>
        @foreach($tags as $tag)
            <tr>
                <td>
                    {{ $tag->tag_name }}
                </td>
                <td>
                    {{ $tag->tag_name }}
                </td>
                <td width="500px" class="disabled">
                    <a class="text-success"
                       href="{{ route('tags.edit',$tag->tag_id) }}"> {{ locale_words('Edit') }}</a></span> |
                    <a class="text-danger"
                       onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('tags.destroy',$tag->tag_id) }}","{{ $tag->tag_id }}")'
                    >{{ __('message.Delete') }}</a>|
                    @if($tag->parent == 0)
                        <a class="text-success"
                           href="{{ route('tags.show',$tag->tag_id) }}">{{ __('message.Create') . ' ' . __('message.New') . ' ' . __('message.Language') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $tags->links() }}
@endsection
