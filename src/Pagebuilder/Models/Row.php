<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Row extends Model{
    
    protected $fillable = [
        'expanded',
        'custom_class',
        'sorting',
        'rowable_type',
        'rowable_id',
    ];
    
    public function columns(){
        return $this->hasMany(Column::class)->orderBy('sorting');
    }
    
}
