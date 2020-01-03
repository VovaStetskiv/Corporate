<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    //

    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_alias', 'alias');
    }

}
