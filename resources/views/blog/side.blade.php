<h3 class="s-head mt-0">{{ __('message.lastPost') }}</h3>
<ul class="list-group list-group-flush blg-side">
    @foreach($lastedPost as $post)
        <li class="list-group-item p-2">
            <a class="row" href="/{!! app()->getLocale() . '/blog/' . changeUrlStyle(mb_strtolower($post->title)) !!}">
                <div class="col-4">
                    <img src="{{ asset('content/images/Blogs/' . $post->image) }}" alt="{{ $post->title }}"
                         class="img-fluid img-rounded"/>
                </div>
                <div class="col-8">
                    <div class="title">
                        <h6>{{ $post->title }}</h6>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>