<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model{
    
    protected $fillable = [
        'language_id',
        'content',
        'slug',
    ];

    protected $casts = [
        'content' => 'array'
    ];
    
    public function language(){
        return $this->belongsTo(Language::class);
    }
    
    public function translatable(){
        return $this->morphTo();
    }
    
}
