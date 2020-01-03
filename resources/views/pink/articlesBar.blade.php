    @if(!$portfolios->isEmpty())
        <div class="widget-first widget recent-posts">
            <h3>{{ Lang::get('ru.articles_latest_portfolios') }}</h3>
                <div class="recent-post group">
                    @foreach($portfolios as $portfolio)


                        <div class="hentry-post group">
                            <div class="thumb-img"><img style="width: 55px" src="{{asset(env('THEME'))}}/images/projects/{{ $portfolio->img->mini }}" alt="001" title="001" /></div>
                            <div class="text">
                                <a href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}" title="{{ $portfolio->title }}" class="title">Section shortcodes &amp; sticky posts!</a>
                                {{ str_limit($portfolio->desc, 128) }}
                                <a class="read-more" href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}">&rarr; {{ Lang::get('ru.read_more') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    @endif
    @if($comments)
        <div class="widget-last widget recent-comments">
            <h3>{{ Lang::get('ru.articles_latest_comments') }}</h3>
            <div class="recent-post recent-comments group">
                @foreach($comments as $comment)
                    <div class="the-post group">
                        <div class="avatar">
                            <img alt="" src="https://www.gravatar.com/avatar/{{ $comment->email ? md5($comment->email) : $comment->user->email }}?d=mm&s=55" class="avatar" />
                        </div>
                        <span class="author"><strong><a href="mailto:{{$comment->email}}">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</a></strong> in</span>
                        <a class="title" href="{{ route('articles.show', ['alias'=>$comment->article->alias]) }}">{{ $comment->article->title }}</a>
                        <p class="comment">
                            {{ $comment->text }} <a class="goto" href="{{ route('articles.show', ['alias'=>$comment->article->alias]) }}">&#187;</a>
                        </p>
                    </div>

                @endforeach
            </div>
        </div>

    @endif