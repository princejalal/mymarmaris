<footer>
    <div class="footer-top text-center">
        <div class="col">{{ locale_words('SocialWeAre') }}</div>
        <div class="col">
            @foreach($contactSocial as $media)
                @if(isset($socialLink[$media->name]) && $media->name != 'telegram' && $media->name != 'whatsapp')
                    <a target="_blank" href="{{ $socialLink[$media->name] }}{{ $media->contact_value }}"
                       class="icon-button {{ $media->name }}"><i
                            class="{{ $media->icon }} fa-2x"></i><span></span></a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                @if(isset($pages))
                    <div class="col-sm-3">
                        <h5>{{ locale_words('Quicklinks') }}</h5>
                        @if(isset($destinations))
                            <ul>
                                @foreach($pages as $page)
                                    @if(\Route::has('page.show.'.$page->page_id))
                                        <li><i class="fas fa-caret-right"></i><a title="@item.text"
                                                                                 href="{{ route('page.show.'.$page->page_id,app()->getLocale()) }}">{{ $page->p_name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                    </div>
                @endif
                @endif
                @if(!check_is_mobile())
                    <div class="col-sm-3  d-none d-sm-block">
                        <h5>{{ locale_words('suggestedtours') }}</h5>
                        @if(isset($suggest))
                            <ul>
                                @foreach($suggest as $sugg)
                                    <li><i class="fas fa-check-double"></i><a title="{{ $sugg->tour_header }}"
                                                                              href="{{ route('item.show',[app()->getLocale(),$sugg->url]) }}">{{ $sugg->tour_header }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="col-sm-3 d-none d-sm-block">
                        <h5>{{ locale_words('mostpreferedtours') }}</h5>
                        @if(isset($footerTours))
                            <ul>
                                @foreach($footerTours as $footTour)
                                    <li><i class="fas fa-check-double"></i><a title="{{ $footTour->tour_header }}"
                                                                              href="{{ route('item.show',[app()->getLocale(),$footTour->url]) }}">{{ $footTour->tour_header }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                <div class="col-sm-3">
                    <h5>{{ locale_words('FindUs') }}</h5>
                    <ul>
                        <li>
                            <img height="68" width="250" src="{{ asset('content/images/' . $logo) }}"
                                 class="logo-footer" alt="My Kemer Tours">
                        </li>
                        @foreach($address as $ad)
                            <li>
                                <i class="fa fa-location-arrow"></i><span>{{ locale_words('Address') }}: </span> {{ $ad->contact_value }}
                            </li>
                        @endforeach
                        <li><i class="fa fa-phone"></i><span>{{ locale_words('Phone') }}: </span><span
                                dir="ltr">{{ $phone->contact_value }}</span>
                        </li>
                        @foreach($emailess as $em)
                            <li><i class="fa fa fa-envelope"></i><span>{{ locale_words('Email') }}: </span><span
                                    dir="ltr">{{ $em->contact_value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row  d-flex align-items-center">
                    <div class="col-md-8 text-center text-md-left">
                        <ul class="list-inline">
                            <li class="list-inline-item text-left">

                            </li>
                            <li class="list-inline-item text-left">

                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-center text-md-right">
                        <p>Copyright {{ date('Y') }}
                            | {{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
</footer>
<div class="loading">
    <div class="loading-inside"></div>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script defer src="{{ asset('js/popper.js') }}"></script>
<script defer src="{{ asset('js/bootstrap.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.lazy-master/jquery.lazy.min.js') }}"></script>
<span id="script"></span>
@yield('js')
</body>
</html>
