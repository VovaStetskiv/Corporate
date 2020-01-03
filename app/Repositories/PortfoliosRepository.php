<?php

namespace Corp\Repositories;


use Corp\Models\Portfolio;

class PortfoliosRepository extends Repository {

    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }

}