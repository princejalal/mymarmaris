<meta name="description" content="{{ $metaDesc }}"/>
<meta name="keywords" content="{{ $metaTags }}"/>
<link rel="canonical" href="{{ config('app.url') . app()->getLocale() }}"/>
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('content/images/favicons/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('content/images/favicons/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('content/images/favicons/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('content/images/favicons/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('content/images/favicons/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('content/images/favicons/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('content/images/favicons/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('content/images/favicons/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('content/images/favicons/apple-icon-180x180.png') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('content/images/favicons/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ffffff">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:url" content="{{ $app->make('url')->to('/') .'/' }}{{ app()->getLocale() }}">
<meta property="og:image" content="{{ (isset($itemImage) ? $itemImage : asset('content/images/logo.png')) }}"/>
