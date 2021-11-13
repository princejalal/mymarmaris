@extends('adminpanel.layouts.app')


@section('content')
    <h4>{{ locale_words('SiteContactFormPosts') }}</h4>
    <hr>
    <table class="table table-responsive">
        <tr>
            <th>
                {{ __('message.UserWebLang') }}
            </th>
            <th>
                {{ __('message.TourName') }}
            </th>
            <th>
                {{ __('message.Name') }}
            </th>
            <th>
                {{ __('message.E_Mail') }}
            </th>
            <th>
                {{ __('message.Phone') }}
            </th>
            <th>
                {{ __('message.Message') }}
            </th>
            <th>
                Send Date
            </th>
            <th></th>
        </tr>
        @foreach($posts as $post)
            <tr class="@if($post->is_read == 0) yeni @endif">
                <td>
                    {{ $post->user_lang }}
                </td>
                <td>
                    {{ $post->name }}
                </td>
                <td>
                    {{ $post->email }}
                </td>
                <td>
                    {{ $post->phone }}
                </td>
                <td>
                    {{ $post->message }}
                </td>
                <td>
                    {{ change_zone($post->created_at)  }}
                </td>
                <td>
                    <a class="text-success"
                       href="{{ route('post.edit',$post->message_id) }}">{{ __('message.Edit') }}</a></span> |
                    <a class="text-danger pointer-event"
                       onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('post.destroy',$post->message_id) }}","{{ $post->message_id }}")'
                    >{{ __('message.Delete') }}</a> |
                    <a class="text-danger"
                       href="{{ route('post.show',$post->message_id) }}">{{ __('message.Details') }} </a>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $posts->links() }}
@endsection
