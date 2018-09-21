<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class ElementType extends Model{
    
    protected $fillable = [
        'name',
        'component',
        'icon',
        'sorting',
    ];
    
    public function columns(){
        return $this->hasMany(Column::class);
    }
    
    
}
