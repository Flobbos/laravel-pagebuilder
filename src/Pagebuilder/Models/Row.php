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
        'alignment',
        'padding_top',
        'padding_bottom',
        'active'
    ];
    
    public function columns(){
        return $this->hasMany(Column::class)->orderBy('sorting');
    }
    
}
