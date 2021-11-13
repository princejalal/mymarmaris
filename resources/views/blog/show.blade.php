@extends('blog.index')
@section('blogHeader')
    <section class="m-head2">
        <h1>{{ $blogContent->title }}</h1>
        <p class="h6">{{ $blogContent->summary }}</p>
    </section>
@endsection
@section('blogContent')
    <div class="container">
        <div class="row  my-3 my-sm-5">
            <main class="col-lg-12">
                <div class="">
                    <img src="{{ asset('content/images/Blogs/big/' . $blogContent->image) }}" alt="{{ $blogContent->title }}" class="img-fluid">
                    <div class="row mt-3 oneblog site-content">
                        <div class="col-sm-12">
                            {!! $blogContent->content !!}
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
@endsection
