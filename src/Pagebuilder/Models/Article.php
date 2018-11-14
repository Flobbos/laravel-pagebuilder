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
        'photo',
        'published_on',
    ];
    
    public function rows(){
        return $this->morphMany(Row::class,'rowable');
    }
    
    public function translations(){
        return $this->morphMany(Translation::class,'translatable');
    }
    
    //Overrides for polymorphic delete
    public function delete(){
        $deleted = parent::delete();
        if($deleted){
            $this->translations()->delete();
            $this->rows()->delete();
        }
    }
    
}
