@if(app()->getLocale() == 'fa' || app()->getLocale() == 'ar')
    <html lang="{{ app()->getLocale() }}" dir="rtl">
    @else
        <html lang="{{ app()->getLocale() }}" dir="ltr">
        @endif
        <head lang="{{ app()->getLocale() }}">
            <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="language" content="{{ app()->getLocale() }}"/>
            <link rel="alternate" href="{{ config('app.url') . 'en' }}" hreflang="x-default"/>
            <link rel="alternate" href="{{ \Request::fullUrl() }}" hreflang="{{ app()->getLocale() }}"/>
            <link rel="canonical" href="{{ \Request::url() }}"/>
            <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
            <title>{{ $title }}</title>
            @include('layouts.meta',['title'=>$title,'metaDesc'=>$metaDesc,'metaTags'=>$metaTags])
            <link
                    href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap&subset=cyrillic,latin-ext"
                    rel="preload" as="style" onload="this.rel='stylesheet'">
            <link
                    href="https://fonts.googleapis.com/css?family=Bangers|Oswald:200,300,400,500,600,700|Prosto+One&display=swap&subset=cyrillic,latin-ext"
                    rel="preload" as="style" onload="this.rel='stylesheet'">
            <link rel="preload" href="{{ asset('style/bootstrap.min.css') }}" as="style" onload="this.rel='stylesheet'">
            <link rel="stylesheet" href="{{ asset('style/style.css') }}">
            {!! check_property($siteInfo,'meta_tags') !!}
            @yield('styles')
            <link rel="preload" href="{{ asset('fontawesome/css/all.min.css') }}" as="style" onload="this.rel='stylesheet'">
        </head>
        <body>
        <div class="webtop">
            <div class="container">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="dropdown">
                        @foreach($languages as $language)
                            <a class="mr-2" title="{{ __($language->lang_eng_name) }}"
                               href="/{!! $language->lang_short_name!!}"><img width="32" height="32"
                                        src="{{ asset($language->flag) }}"
                                        alt="{{ __($language->lang_eng_name) }}"/>
                            </a>
                        @endforeach
                    </div>
                    <div class="d-lg-none d-sm-flex p-2 border-left">
                        <a href="tel:{{ check_property($siteInfo,'phone') }}" class="h5"><i class="fas fa-phone"></i>{{ check_property($siteInfo,'phone') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="webtop-2">

            <div class="d-flex justify-content-around align-items-center flex-column flex-sm-row">
                <div class="order-3 order-sm-1 d-flex justify-content-between align-items-center mob-log ">
                    <a href="/{{ app()->getLocale() }}">
                        <img height="68" width="250"
                                data-src="{{ asset('content/images/'.$logo) }}"
                                class="uplogo lazy"/>
                                </a>
                    <button class="navbar-toggler d-inline-block d-sm-none" type="button" data-toggle="collapse"
                            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <i class="fas fa-bars"></i>
                            </span>
                    </button>
                </div>
                @if(!check_is_mobile())
                    <div class="text-center order-2 order-sm-2">
                        <div class="slg1">{{ locale_words('BookNow') }}</div>
                        <div class="slg2">{{ locale_words('PayDuring') }}</div>
                    </div>
                @endif
                <div class="d-none d-sm-inline-block order-1 order-sm-3">
                    <div class="dropdown">
                        <a class="dropdown-toggle syt" id="alltoursmenu" href="#" data-toggle="dropdown"><span>{{ locale_words('ChooseTour') }} :</span>
                            {{ locale_words('SelectTour') }}</a>

                        @if(isset($allTours))
                            <ul class="dropdown-menu">
                                @foreach($allTours as $tour)
                                    <li><a class="dropdown-item" title="{{ $tour->tour_header }}"
                                           href="{{ route('item.show',[app()->getLocale(),changeUrlStyle($tour->url)]) }}"><small>{{ $tour->tour_header }}</small></a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="tpon"><a href="tel:{{ check_property($siteInfo,'phone') }}">{{ check_property($siteInfo,'phone') }}</a></div>
                    <div class="tponsub">(24/7 {{ locale_words('OnlineService') }})</div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-white">
            <div class="row">
                <nav class="container   navbar navbar-expand-lg p-0 main-navbar">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav w-100 nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" href="/{{ app()->getLocale() }}">{{ locale_words('Home') }}<span
                                            class="sr-only">(current)</span></a>
                            </li>
                            @foreach($pageKind as $kind)
                                @if(\Route::has('page.kind.'.$kind))
                                    @php
                                        $pageUrl = App\Pages::select('pages.page_id','page_info.url')
                                        ->where('kind',$kind)
                                        ->leftJoin('page_info','page_info.page_id','=','pages.page_id')->first();

                                    @endphp

                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ route('page.kind.'.$kind,app()->getLocale()) }}">{{ __('category.'.$kind) }}</a>
                                    </li>

                                @endif
                            @endforeach
                            @if(check_is_mobile())
                                <div class="dropdown text-center pt-3 pb-3">
                                    <a class="dropdown-toggle syt" id="alltoursmenu" href="#" data-toggle="dropdown">
                                        {{ locale_words('Destination') }}</a>

                                    @if(isset($destinations))
                                        <ul class="dropdown-menu">
                                            @foreach($destinations as $dest)
                                                <li><a class="dropdown-item text-center"
                                                       title="{{ $dest->menu_header }}"
                                                       href="{{ route('item.show',[app()->getLocale(),changeUrlStyle($dest->url)]) }}">{{ $dest->menu_header }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/{{ app()->getLocale() }}/blog">{{ locale_words('blog') }}</a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link" target="_blank"
                                   href="https://vk.com/ekskursii.v.marmarise">{{ locale_words('GUESTBOOK') }}</a>
                            </li>
                            <li class="nav-item @if(request()->segment(2) == 'contact') active @endif">
                                <a class="nav-link"
                                   href="{{ route('contact.show',app()->getLocale()) }}">{{ locale_words('Contact') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
        @if(!check_is_mobile())
            <nav class="navbar-expand-lg p-0 district-navbar">
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(isset($destinations))
                        <ul class="navbar-nav w-100 nav-justified">
                            @foreach($destinations as $dest)
                                <li class="nav-item "><a class="nav-link dest-btn"
                                                        href="{{ route('item.show',[app()->getLocale(),$dest->url]) }}">{{ $dest->menu_header }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </nav>
        @endif

        @if (Session::has('message'))
            {!! session('message') !!}
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
@endif
