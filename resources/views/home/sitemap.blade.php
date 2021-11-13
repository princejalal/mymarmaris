<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php $lastMode = date('c', time()); ?>
    <url>
        <loc>{{ config('app.url') . app()->getLocale() }}</loc>
        <lastmod><?= $lastMode ?></lastmod>
        <priority>0.80</priority>
    </url>
    @foreach ($dests as $dest)
        <url>
            <loc>{!!   route('item.show',[app()->getLocale(),$dest->url]) !!}</loc>
            <lastmod><?= $lastMode ?></lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ route('blog.index',app()->getLocale()) }}</loc>
        <lastmod><?= $lastMode ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ route('contact.show',app()->getLocale()) }}</loc>
        <lastmod><?= $lastMode ?></lastmod>
        <priority>0.80</priority>
    </url>
    @foreach ($tours as $tour):
    <url>
        <loc>{!!   route('item.show',[app()->getLocale(),$tour->url])  !!}</loc>
        <lastmod><?= $lastMode ?></lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach
    @foreach ($pages as $page)
        @if(\Route::has('page.show.'.$page->page_id))
            <url>
                <loc>{!!  route('page.show.'.$page->page_id,app()->getLocale()) !!}</loc>
                <lastmod><?= $lastMode ?></lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach($pageKind as $kind)
        @if(\Route::has('page.kind.'.$kind))
            @php
                $pageUrl = App\Pages::select('pages.page_id','page_info.url')
                ->where('kind',$kind)
                ->leftJoin('page_info','page_info.page_id','=','pages.page_id')->first();

            @endphp
            <url>
                <loc>{{ route('page.kind.'.$kind,app()->getLocale()) }}</loc>
                <lastmod><?= $lastMode ?></lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach
    @foreach ($blogs as $blog):
    <url>
        <loc>{!!  route('blog.show',[app()->getLocale(),mb_strtolower(changeUrlStyle($blog->title))]) !!}</loc>
        <lastmod><?= $lastMode ?></lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach
</urlset>
