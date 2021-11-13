@extends('layouts.app')

@section('content')

    <h1 class="m-head2 h5">{{ check_property($pageInfo,'header') }}</h1>

    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-8">
                <div class="standart-pages fullImgWidth">
                    {!! check_property($pageInfo,'content') !!}
                    {!! check_property($pageInfo,'description') !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="standart-pages">
                    <div class="jumbotron @if(check_is_mobile()) m-0 @endif">
                        <p class="display-4 text-center">{{ config('app.siteName') }}</p>
                        <p class="bg-light text-center mt-3 h6 p-2">{{ __('message.BeyondTheExpectations') }}</p>
                        <p class="lead bg-light text-center p-2">{{ __('message.OperatorofAlanyaTourLeader') }}</p>
                        <hr class="my-4">
                        <ul class="list-group mylist">
                            @foreach($allPages as $page)
                                @if(\Route::has('page.show.'.$page->page_id))
                                    <li class="list-group-item @if($page->url == \Illuminate\Support\Facades\Request::segment(2)) aktif  @endif"><a
                                                title="{{ $page->page_name }}" href="{{ route('page.show.' .$page->page_id,app()->getLocale()) }}">{{ $page->page_name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

@endsection
