@if( count($portfolios) > 0 )
    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                <h3 class="title">{{ trans('ru.latest_projects_title') }}</h3>

                @foreach( $portfolios as $key => $portfolio )
                    @if( $key == 0 )
                        <div class="hentry work group portfolio-sticky portfolio-full-description">
                            <div class="work-thumbnail">
                                <a class="thumb"><img src="{{asset(env('THEME'))}}/images/projects/{{$portfolio->img->max}}" alt="0081" title="0081" /></a>
                                <div class="work-overlay">
                                    <h3><a href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}">{{ $portfolio->title }}</a></h3>
                                    <p class="work-overlay-categories"><img src="{{asset(env('THEME'))}}/images/categories.png" alt="Categories" /> in: <a href="category.html">{{ $portfolio->filter->title  }}</a></p>
                                </div>
                            </div>
                            <div class="work-description">
                                <h2><a href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}">{{ $portfolio->title }}</a></h2>
                                <p class="work-categories">in: <a href="#">{{ $portfolio->filter->title  }}</a></p>
                                <p>{{ str_limit($portfolio->text, 200) }}</p>
                                <a href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}" class="read-more">|| Read more</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                        @continue
                    @endif

                @if($key == 1)
                    <div class="portfolio-projects">
                @endif
                        <div class="related_project {{ ($key == (count($portfolios)) -1) ? 'related_project_last' : ''  }}">
                            <div class="overlay_a related_img">
                                <div class="overlay_wrapper">
                                    <img src="{{asset(env('THEME'))}}/images/projects/{{$portfolio->img->mini}}" alt="0061" title="0061" />
                                    <div class="overlay">
                                        <a class="overlay_img" href="{{asset(env('THEME'))}}/images/projects/{{$portfolio->img->path}}" rel="lightbox" title=""></a>
                                        <a class="overlay_project" href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}"></a>
                                        <span class="overlay_title">{{ $portfolio->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <h4><a href="{{ route('portfolio.show', ['alias' => $portfolio->alias]) }}">{{ $portfolio->title }}</a></h4>
                            <p>{{ str_limit($portfolio->text, 80) }}</p>
                        </div>



                @endforeach
                    </div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
@endif