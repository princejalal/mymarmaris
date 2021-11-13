<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('content/images/favicon.png') }}">
    <title>{{ $title }}</title>
    @yield('style')
    <link href="{{ asset('admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/bootstrap-extension.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/sidebar-nav.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/colors/blue.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/myStyle.css') }}" rel="stylesheet"/>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0 ">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse"
               data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part">
                <a class="logo" href="/adminpanel">

                    <b><img src="{{ asset('content/images/favicons/android-icon-48x48.png') }}" alt="home"/></b>
                    <span class="hidden-xs">{{ config('app.name') }}</span>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i
                            class="icon-arrow-left-circle ti-menu"></i></a></li>
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="/en/Manage"> <img
                            src="{{ asset('/content/images/user.png') }}" alt="user-img" width="36"
                            class="img-circle"><b class="hidden-xs"> Hello {{ auth()->user()->name }}!</b> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li><a href="{{ route('password.request',app()->getLocale()) }}"><i class="ti-settings"></i> {{ locale_words('ChangePass') }}</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        @if(auth()->user()->user_role == 'Admin')
                            <li><a href="{{ route('manageUser.index') }}"><i class="ti-wallet"></i> {{ locale_words('ManageUser') }}</a></li>
                        @endif
                        <li role="separator" class="divider"></li>
                        <li class="text-center">
                            <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit"><i
                                            class="fa fa-power-off"></i> {{ locale_words('Logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
@include('adminpanel.layouts.sidemenu')
