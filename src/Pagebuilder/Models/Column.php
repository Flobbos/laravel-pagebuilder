<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Flobbos\TranslatableDB;

class Column extends Model{
    
    use TranslatableDB\TranslatableDB;
    
    protected $fillable = [
        'project_row_id',
        'element_type_id',
        'column_size',
        'custom_class',
        'sorting',
        'active'
    ];
    
    public $translatedAttributes = ['content'];
    public $fallbackAttributes = ['content'];
    
    public function row(){
        return $this->belongsTo(Row::class);
    }

    public function element_type(){
        return $this->belongsTo(ElementType::class);
    }
    
}
