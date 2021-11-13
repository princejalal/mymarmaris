<div class="sld-rounder">
    <div class="text-center pt-lg-5">
        <h2 class="text-white h3">{{ locale_words('FromBlog') }}</h2>
    </div>
    <div id="topSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @php $d=0 @endphp
            @foreach($blogs as $blog)
                <div class="carousel-item @if($d == 0) active @endif">
                    <div class="container my-5 py-5 z-depth-1 sec-slider">
                        <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h3 class="font-weight-bold h3"><a class="text-white"
                                                                       href="{{ route('blog.show',[app()->getLocale(),changeUrlStyle(mb_strtolower($blog->title))]) }}">{{ $blog->title }}</a>
                                    </h3>
                                    <p class="text-white font-weight-bold">{{ $blog->summary }}</p>
                                    <a class="btn btn-danger btn-md ml-0"
                                       href="{{ route('blog.show',[app()->getLocale(),changeUrlStyle(mb_strtolower($blog->title))]) }}"
                                       role="button">{{ locale_words('ReadMore') }}<i
                                                class=""></i></a>
                                </div>
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <div class="view overlay z-depth-1-half">
                                        <img src="{{ asset('content/images/logo.png') }}" data-src="{{ asset('content/images/Blogs/' . $blog->image) }}"
                                             class="img-fluid lazy"
                                             alt="{{ $blog->title }}">
                                        <a href="">
                                            <div class="mask rgba-white-light"></div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                @php $d++ @endphp
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#topSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#topSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>