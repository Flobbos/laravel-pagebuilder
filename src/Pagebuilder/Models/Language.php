<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    protected $fillable = [
        'name',
        'locale'
    ];
}
