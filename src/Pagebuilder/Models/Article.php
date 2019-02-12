<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Article Extends Model{
    
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
