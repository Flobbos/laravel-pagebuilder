<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class ColumnTranslation extends Model{
    
    protected $fillable = [
        'column_id',
        'language_id',
        'content'
    ];
    
    protected $casts = [
        'content' => 'array'
    ];


    public function column(){
        return $this->belongsTo(Column::class);
    }
    
}
