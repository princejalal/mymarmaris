@extends('blog.index')

@section('blogHeader')
    <h1 class="m-head2">{!! check_property($blogInfo,'header')!!}</h1>
@endsection

@section('blogContent')
    @if(!request('page'))
        <div class="m-3">
            {!! check_property($blogInfo,'content') !!}
        </div>
    @endif
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-sm-6">
                    <a class=" card text-center"
                       href="{{ route('blog.show',[app()->getLocale(),changeUrlStyle(mb_strtolower($post->title))]) }}">
                        <img class="card-img-top img-fluid" src="{{ asset('content/images/Blogs/' . $post->image) }}">
                        <div class="card-header">
                            <h2>{{ $post->title }}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $post->summary }}</p>

                        </div>
                        <div class="card-footer text-muted">
                            <div class=" d-flex justify-content-between">
                                <div>
                                    <i class="fas fa-clock"></i>{{ humanTiming(strtotime($post->created_at)) }} Ago
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="align-content-center">
            {{ $posts->links() }}
        </div>
    </div>
    @if(!request('page'))
        {!! check_property($blogInfo,'description')!!}
    @endif
@endsection
