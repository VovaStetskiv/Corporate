<?php

namespace Corp\Models;

use Corp\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}