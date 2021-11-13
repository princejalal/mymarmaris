@extends('layouts.app')
@section('styles')
    @include('schema.main',['homeData'=>$homeData,'tours'=>$tours])
    @include('schema.tour',['tours'=>$tours])
@endsection
@section('content')
    <h1 class="m-head">{{ check_property($pageInfo,'header') }}</h1>
    <div class="container my-bg p-3 site-content">
        <div class="row p-4">
            {!! change_img_class_and_src(check_property($pageInfo,'content')) !!}
        </div>
        <div class="row">
            @include('layouts.tours',['tours'=>$tours])
        </div>
        <div class="row p-4 site-content">
            {!! change_img_class_and_src(check_property($pageInfo,'description')) !!}
        </div>
    </div>
@endsection