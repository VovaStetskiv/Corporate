<?php

namespace Corp\Http\Controllers;

use Corp\Models\Article;
use Corp\Models\Category;
use Corp\Models\Menu;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\SlidersRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class ArticleController extends SiteController
{
    //

    public function __construct( PortfoliosRepository $portfoliosRepository, ArticlesRepository $articlesRepository, CommentsRepository $commentsRepository )
    {
        parent::__construct( new MenusRepository(new Menu()) );

        $this->porifolios_repository = $portfoliosRepository;
        $this->articles_repository = $articlesRepository;
        $this->comments_repository = $commentsRepository;

        $this->bar = 'right';
        $this->template = env('THEME').'.articles';

    }

    public function index($catAlias = false)
    {
        /*dd($catAlias);*/

        $this->title = 'Home page title';
        $this->meta_desc = 'Home page meta_description';
        $this->keywords = 'Home page keywords';

        $articles = $this->getArticles($catAlias);

        $content = view(env('THEME').'.artilces_content')->with(['articles'=> $articles])->render();
        $this->template_vars = array_add($this->template_vars,'content', $content);

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $comments = $this->getComments(config('settings.recent_comments'));


        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios])->render();


        return $this->renderOutput();

    }

    public function show($alias)
    {
        $article = $this->articles_repository->one( $alias,"*", ['user', 'categories', 'comments.user'] );

        if($article) {
            $article->img = json_decode($article->img);
        }

        $content = view(env('THEME').'.single_article')->with(['article' => $article])->render();

        $this->template_vars = array_add($this->template_vars,'content', $content);

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $comments = $this->getComments(config('settings.recent_comments'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios])->render();


        return $this->renderOutput();

    }

    public function getArticles($alias = false)
    {

        if($alias) {

           $category = Category::select('id')->where('alias', $alias)->first();
           $articles = $category->articles()->paginate(3);

           $articles = $this->articles_repository->check($articles);

        } else {
            $articles = $this->articles_repository->get('*', false, true);
        }


        if($articles) {
            $articles->load('user', 'categories', 'comments');
        }

        return $articles;

    }

    public function getPortfolios($take)
    {
        return  $this->porifolios_repository->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias'], $take);
    }
    
    public function getComments($take)
    {

        $comments = $this->comments_repository->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);

        if($comments) {
            $comments->load('article','user');
        }

        return $comments;
    }


}
