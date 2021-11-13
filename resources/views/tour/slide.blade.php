<div id="in_th_021" class="carousel slide in_th_below_021 thumb_scroll_x  swipe_x ps_easeOutInCubic mt-2"
     data-ride="carousel" data-pause="hover" data-interval="2000" data-duration="200">
    <ol class="carousel-indicators">
        @foreach($tourPhoto as $key => $value)
            <li data-target="#in_th_021" data-slide-to="{{ $key }}"
                class="@if($key == 0) active @endif">
            </li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @if(check_is_mobile()) @php($big='/') @else @php($big = '/big/') @endif
        @foreach($tourPhoto as $key => $value)
            <div class="carousel-item @if($key == 0) active @endif">
                <img class="lazy" data-src="{{ asset('content/images/Tours/' . $tourId . $big . $tourPhoto[$key]->photo_path) }}"
                     alt="{{ $tourInfo->tour_name }}"/>
            </div>
        @endforeach
    </div>
    <!--======= Left Button =========-->
    <a class="carousel-control-prev thumbnail_image_carousel_control_left" href="#in_th_021"
       data-slide="prev">
                        <span class="fa fa-chevron-circle-left thumbnail_image_carousel_control_icons"
                              aria-hidden="true"></span>
    </a>
    <!--======= Right Button =========-->
    <a class="carousel-control-next thumbnail_image_carousel_control_right" href="#in_th_021"
       data-slide="next">
        <span class="fa fa-chevron-circle-right " aria-hidden="true"></span>
    </a>
</div>