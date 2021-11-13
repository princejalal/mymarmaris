@extends('adminpanel.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <p>
                    <a href="{{ route('blogs.create') }}">Add New Blog</a>
                </p>
                <table class="table table-responsive">
                    <tbody>
                    <tr>
                        <th>
                            {{ locale_words('Header') }}
                        </th>
                        <th>
                            {{ locale_words('Languages') }}
                        </th>
                        <th>
                            {{ locale_words('Date') }}
                        </th>
                        <th>
                            {{ locale_words('Views') }}
                        </th>
                        <th>
                            {{ locale_words('Photo') }}
                        </th>
                        <th></th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>{{ $post->lang_short_name }}
                            </td>
                            <td>
                                {{ $post->created_at }}
                            </td>
                            <td>
                                {{ $post->view }}
                            </td>
                            <td>
                                <img
                                    src="{{ asset('content/images/Blogs/' . $post->image) }}"
                                    style="max-width:100px;" class="img-responsive">
                            </td>
                            <td>
                                <a href="{{ route('blogs.edit',$post->blog_id) }}">{{ locale_words('Edit') }}</a> |
                               <a class="text-danger pointer-event"
                                    onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('blogs.destroy',$post->blog_id) }}","{{ $post->blog_id }}")'
                                >{{ __('message.Delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
