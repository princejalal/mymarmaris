@extends('layouts.app')

@section('content')
   @yield('blogHeader')
    <div class="container blg">
        <div class="row">
            <main class="col-sm-8 mt-3">
                    @yield('blogContent')
            </main>
            <aside class="col-lg-4 mt-3">
                @include('blog.side',['lastedPost'=>$lastedPost])
            </aside>
        </div>
    </div>
@endsection
