<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model{
    
    protected $guarded = [];
    
    public function model(): MorphTo {
        return $this->morphTo();
    }

}
