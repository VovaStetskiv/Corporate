<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

use Menu;

class SiteController extends Controller
{
    //
    protected $porifolios_repository;
    protected $sliders_repository;
    protected $articles_repository;
    protected $menus_repository;
    protected $comments_repository;

    protected $title;
    protected $meta_desc;
    protected $keywords;

    protected $template;

    protected $template_vars = [];

    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    protected $bar = 'no';


    public function __construct( MenusRepository $menus_repository )
    {
        $this->menus_repository = $menus_repository;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.navigation')->with(['menu' => $menu])->render();

        $this->template_vars = array_add($this->template_vars,'navigation', $navigation);

        if( $this->contentRightBar ) {
            $rightBar = view(env('THEME').'.rightBar')->with(['content_rightBar' => $this->contentRightBar])->render();
            $this->template_vars = array_add($this->template_vars,'rightBar', $rightBar);
        }
        $this->template_vars = array_add($this->template_vars,'bar', $this->bar);

        $footer = view(env('THEME').'.footer')->render();

        $this->template_vars = array_add($this->template_vars,'footer', $footer);

        $this->template_vars = array_add($this->template_vars,'title', $this->title);
        $this->template_vars = array_add($this->template_vars,'meta_desc', $this->meta_desc);
        $this->template_vars = array_add($this->template_vars,'keywords', $this->keywords);

        return view($this->template)->with($this->template_vars);
    }

    protected function getMenu()
    {
        $menu = $this->menus_repository->get();

        $menuBulder =  Menu::make('MyNav', function ($m) use ($menu){

            foreach ( $menu as $item ){

                if( $item->parent_id == 0 ) {
                    $m->add($item->title, $item->path)->id($item->id);
                }
                else {
                    if( $m->find($item->parent_id) ) {
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }


            }

        });

        return $menuBulder;
    }


}
