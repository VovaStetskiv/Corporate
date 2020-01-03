<?php

namespace Corp\Models;

use Corp\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_article', 'article_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }


}
