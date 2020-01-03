<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\SlidersRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Illuminate\Support\Facades\Config;

class IndexController extends SiteController
{

    public function __construct(SlidersRepository $slidersRepository, PortfoliosRepository $portfoliosRepository, ArticlesRepository $articlesRepository )
    {
        parent::__construct( new MenusRepository(new Menu()) );
        /*dd($articles1Repository);*/


        $this->sliders_repository = $slidersRepository;
        $this->porifolios_repository = $portfoliosRepository;
        $this->articles_repository = $articlesRepository;

        $this->bar = 'right';
        $this->template = env('THEME').'.index';

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Home page title';
        $this->meta_desc = 'Home page meta_description';
        $this->keywords = 'Home page keywords';

        $portfolios = $this->getPortfolios();

        $content = view(env('THEME').'.content')->with(['portfolios' => $portfolios])->render();

        $this->template_vars = array_add($this->template_vars,'content', $content);

        $sliderItems = $this->getSliders();
       /* dd($sliderItems);*/
        $sliders = view(env('THEME').'.slider')->with(['slider' => $sliderItems])->render();

        $this->template_vars = array_add($this->template_vars,'slider', $sliders);

        $articles = $this->getArticles();

        $this->contentRightBar = view(env('THEME').'.indexBar')->with(['articles' => $articles])->render();

        return $this->renderOutput();

    }

    public function getSliders()
    {
         $slider = $this->sliders_repository->get();

         if( $slider->isEmpty() ) {
             return false;
         }
        $slider->transform(function ($item, $key){
             $item->img = Config::get('settings.slider_path').'/'.$item->img;
            return $item;
        });

        return $slider;
    }

    protected function getPortfolios()
    {
        return $this->porifolios_repository->get('*', Config::get('settings.home_port_count'));
    }

    protected function getArticles()
    {
        return  $this->articles_repository->get(['alias','title', 'img', 'created_at'], Config::get('settings.home_articles_count'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
