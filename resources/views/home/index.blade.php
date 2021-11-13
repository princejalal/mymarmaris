@extends('layouts.app')
@section('styles')
    @include('schema.main',['homeData'=>$homeData,'tours'=>$tours])
    @include('schema.tour',['tours'=>$tours])
@endsection
@section('content')
    <section class="m-head">
        <h1>{{ check_property($homeData,'header') }}</h1>
        <p class="h6">{{ check_property($content,'content') }}</p>
    </section>
    <section class="tours-container">
        <h2 class="m-head">{{ locale_words('Tours 2021') }}</h2>
        <div class="container">
            <div class="row">
                @include('layouts.tours',['tours'=>$tours])
            </div>
        </div>
    </section>
    <section class="site-content">
        {!! change_img_class_and_src(check_property($homeData,'content')) !!}
    </section>
    @include('home.blogSlider',['blogs'=>$blogs])
    <section class="site-content">
        {!! change_img_class_and_src(check_property($homeData,'description')) !!}
    </section>
@endsection

