<?php isset($title) ? $title = $title : $title = 'adminpanel'; ?>
@include('adminpanel.layouts.header',['title' => $title])
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                <h3 class="page-title"></h3>
            </div>
            <!-- .breadcrumb -->
            <div class="col-lg-8 col-sm-6 col-md-7 col-xs-12">
                <a href="/" target="_blank"
                   class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light"><i
                        class="fa fa-search"></i>
                    {{ __('message.ViewWebsite') }}
                </a>
                <ol class="breadcrumb">
                    <li><a href="/adminpanel">{{ __('message.Dashboard') }}</a></li>
                    <li class="active">{{ Request::segment(2) }}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                <div id="admin_error">

                </div>
                <div class="white-box">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@include('adminpanel.layouts.footer')
