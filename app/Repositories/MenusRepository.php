<?php

namespace Corp\Repositories;

use Corp\Models\Menu;


class MenusRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }
    
}