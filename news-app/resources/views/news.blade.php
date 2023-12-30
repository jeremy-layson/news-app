<div>
    <form action="" method="GET">
        <input type="text" id="search" name="search" placeholder="search term" value="{{$search}}">
        <button type="submit">Search</button>
    </form>
</div>

<div class="articles">
    @foreach($articles as $key => $article)
        <div class="article">
            <h3><a href="{{ $article['url'] }}">{{ $article['title'] }}</a></h3>
            <div>
                <p>{{ $article['date'] }}</p>
                <button>{{ $article['is_pinned'] ? 'Unpin' : 'Pin'}}</button>
            </div>
            <hr/>
        </div>
    @endforeach
</div>