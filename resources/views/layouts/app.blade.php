<?php isset($title) ? $title = $title : $title = $pageInfoEng->title; ?>
<?php isset($metaDesc) ? $metaDesc = $metaDesc : $metaDesc = $pageInfoEng->meta_desc; ?>
<?php isset($metaTags) ? $metaTags = $metaTags : $metaTags = $pageInfoEng->meta_tags; ?>
<?php isset($scrollText) ? $scrollText = $scrollText : $scrollText = $pageInfoEng->scrolling_text; ?>
@include('layouts.header',['title' => $title,'scroll_text'=>$scrollText,'metaDesc'=>$metaDesc,'metaTags'=>$metaTags])
@yield('content')

@include('layouts.footer')
