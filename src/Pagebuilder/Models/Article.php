<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Flobbos\TranslatableDB;

class Article extends Model{
    
    use TranslatableDB\TranslatableDB;
    
    public $translatedAttributes = ['content'];
    public $fallbackAttributes = ['content'];
    
    protected $fillable = [
        'name',
        'published_on',
    ];
    
    public function rows(){
        return $this->morphMany(Row::class);
    }
    
    public function translations(){
        return $this->morphMany(Translation::class);
    }
    
}
