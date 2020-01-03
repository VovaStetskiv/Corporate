<?php

namespace Corp\Repositories;


use Corp\Models\Article;

class ArticlesRepository extends Repository {

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    
}