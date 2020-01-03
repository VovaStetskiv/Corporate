<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'category_article', 'category_id', 'article_id', 'id');
    }

}
