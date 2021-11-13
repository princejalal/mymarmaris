<h4 class="s-head my-0">{{ $tourInfo->tour_header. ' ' .locale_words('Explanations') }}</h4>
<div class="tour-explanation">
{{--    @if(!check_is_mobile())--}}
{{--        @if(isset($TourGif->photo_path))--}}
{{--            <img alt="@item.Gif"--}}
{{--                 src="{{ asset('content/images/Tours/' . $tour->tour_id . '/' . $TourGif->photo_path) }}"/>--}}
{{--        @endif--}}
{{--    @endif--}}
    {!! $tourInfo->content !!}
</div>