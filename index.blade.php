@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style/slider/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/slider/move_1_columns_5.css') }}">
    <link rel="stylesheet" href="{{ asset('style/slider/shortcodes.min.css') }}">
    <link href="{{ asset('js/BootstrapDateTimePicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('style/baguetteBox.min.css') }}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{ asset('js/baguetteBox.js') }}"></script>
    <script src="{{ asset('style/slider/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('style/slider/bootstrap_carousel_types.js') }}"></script>
    <script src="{{ asset('js/tour.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('js/BootstrapDateTimePicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.jqueryui-marker-datepicker').datetimepicker({
                showSecond: false,
                dateFormat: 'dd/MM/yyyy',
                timeFormat: 'HH:mm'
            });
        });
    </script>

    <script>
     window.onload = function () {
        baguetteBox.run('.baguetteBoxOne', {
            animation: 'fadeIn',
            noScrollbars: true
        });


        if (typeof oldIE === 'undefined' && Object.keys) {
            hljs.initHighlighting();
        }

        var year = document.getElementById('year');
        year.innerText = new Date().getFullYear();
    };
    
    // config
    const fontMin = 12; //px
    const fontMax = 25; //px
    const valueAttributeName = 'tag-value'; // tag in which we puted value
    const tagsSelector = '[tag-value]'; // tags elemnts selector
    const computeColor = true; // flag, if true color will be computed with size

    // mechanism
    const values = [];
    document.querySelectorAll(tagsSelector).forEach(tag => {
        const tagValue = tag.getAttribute(valueAttributeName);

        values.push({
            el: tag,
            val: Number(tagValue)
        })
    });

    const valuesSorted = values.sort((a, b) => a.val - b.val);
    const valueMax = valuesSorted[valuesSorted.length - 1].val;

    valuesSorted.forEach(x => {
        const { val, el } = x;

        const fontSize = Math.floor(
            (val / valueMax) * (fontMax - fontMin + 1) + fontMin
        );

        if (computeColor) {
            const color = Math
                .abs(
                    Math.floor(((val / valueMax) * 515) - 200)
                )
                .toString(16)
                .repeat(3);

            el.style.color = `#${color}`;
        }

        el.style.fontSize = `${fontSize}px`;
    });
</script>

@endsection

@section('headerSlider')
 <div class="col">
        <div class="slider-header">
            <h1>{{ check_property($tourInfo,'tour_header') }}</h1>
            <p>{{ check_property($tourInfo,'tour_difference') }}</p>
        </div>
</div>
@endsection


@section('content')

<div class="container">
    <div class="row bg-tour-content">
        @if(count($tourPhoto) > 3)
        <div id="slider_18" class="carousel slide columns_move_1 swipe_x ps_slowSpeedy" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="1000" data-column="4" data-m1200="4" data-m992="3" data-m768="2" data-m576="1">
            <div class="carousel-inner" role="listbox">
               @foreach($tourPhoto as $key => $value)  
                    
                        <div class="carousel-item @if($key == 0) active  @endif">
                            <div class="row baguetteBoxOne gallery">
                                
                                    <a class="col"  href="{{ asset('content/images/Tours/' . $tourId . '/big/' .$tourPhoto[$key]->photo_path) }}">
                                        <img class="img-rounded img-thumbnail"  src="{{ asset('content/images/Tours/' . $tourId . '/' .$tourPhoto[$key]->photo_path) }}" alt="{{ $tourInfo->tour_name }}">
                                    </a>
                                @foreach($tourPhoto as $j => $k)
                                    @if($j != $key )
                                        <a class="col" style="display:none;" href="{{ asset('content/images/Tours/' . $tourId . '/big/' .$tourPhoto[$j]->photo_path) }}"></a>
                                    @endif
                               @endforeach
                            </div>
                        </div>
                     
                @endforeach 
            </div>
            <a class="carousel-control-prev ps_control_left ps_bottom_left_x" href="#slider_18" data-slide="prev">
                <i class="fas fa-angle-left"></i>
            </a>
            <a class="carousel-control-next ps_control_right ps_bottom_right_x" href="#slider_18" data-slide="next">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        @endif
        <div class="col-sm-12">
            <div class="row detailing">
                    <div class="col-sm col-12">
                        <div class="head">
                            {{ __('message.Tourdays') }}
                        </div>
                        <div class="cont">
                            {{ check_property($tourProgram,'tour_days') }}
                        </div>
                        <br />
                        <div class="head">
                            {{ __('message.tourhours') }}
                        </div>
                        <div class="cont">
                            {{ check_property($tourProgram,'tour_hours') }}
                        </div>
                        <br />
                        <div class="head align-self-start">
                            {{ __('message.Includes') }}
                        </div>
                        <div class="cont">
                            {{ check_property($tourProgram,'tour_includes') }}
                        </div>
                        
                    </div>
                    <div class="col-sm col-12">
                        <div class="head">
                            {{ __('message.excludes') }}
                        </div>
                        <div class="cont">
                            {{ check_property($tourProgram,'tour_excludes') }}
                        </div>
                    </div>
                    <div class="col-sm col-12">
                       
                        <div class="head">
                            {{ __('message.dontForgets') }}
                        </div>
                        <div class="cont">
                            {{ check_property($tourProgram,'dont_forget') }}
                        </div>
                    </div>
                    <div class="col-sm col-12 prices">
                        <h6 class="text-center"> {{ locale_words('Price') }}</h6>
                        @foreach($prices as $price)
                            <div class="head">
                               {{ __('message.'.$price->age_range) }}
                                @if(isset($tour->min_child) && isset($tour->max_child) && $price->age_range == 'child')
                                    ({{ $tour->min_child .' - ' .  $tour->max_child}} )
                                @endif
                                @if(isset($tour->min_child) && isset($tour->max_child) && $price->age_range == 'infants')
                                    (0 - {{  $tour->min_child - 1}} )
                                @endif
                            </div>
                            <div class="cont">
                                @if($price->price == 0)
                                    {{ locale_words('free') }}
                                @else
                                    {{ $price->price }} 
                                    <i class="fas fa-dollar-sign"></i>
                                @endif
                                
                            </div>
                            <br />
                           @endforeach 
                    </div>
            </div>
        </div>

    </div>
    <div class="row plan">
        <div class="col-sm-4 ">
            @if(isset($tourProgram->tour_program))
                <h2 class="text-center h3 bg-purple">{{ locale_words('MiniProgramm') }}</h2>
                @php
                    $prog = str_replace('<ul>','<ul class="list-group list-group-flush">',$tourProgram->tour_program);
                    $program = str_replace('<li>','<li class="list-group-item"><i class="fas fa-caret-right"></i>',$prog);
                @endphp
                {!! $program !!}
            @endif
            <div class="tags d-none d-sm-inline-block" >
                @php $tagIds = explode(',',$tourInfo->meta_tags)  @endphp
                <div class="main">
                    <div class="tag-cloud">
                        @foreach ($tagIds as $key => $value)
                            <div tag-value="{{ $key }}">
                                {{ $tagIds[$key] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            @include('tour.reservation')
            <hr />
            <h4>{{ locale_words('Explanations') }}</h4>
            {!! check_property($tourInfo,'content') !!}    
        </div>
        <div class="col-12">
                <hr />
                <h4 class="mb-2">{{ locale_words('othersimilartours') }}</h4>
               <div class="container">
                    <div class="row">
                        @include('layouts.tours',['tours'=> $sameTours])
                    </div>
               </div>
        </div>
    </div>
</div>
@endsection
