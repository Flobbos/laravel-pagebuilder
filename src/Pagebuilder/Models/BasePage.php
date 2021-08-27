<?php

namespace Flobbos\Pagebuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Flobbos\Pagebuilder\Models\Translation;
use Flobbos\TranslatableDB;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasePage extends Model
{
    use SoftDeletes;
    use TranslatableDB\TranslatableDB;

    public $translatedAttributes = ['content', 'slug'];
    public $fallbackAttributes = ['content', 'slug'];

    protected $translationModel = Translation::class;
    protected $translationForeignKey = 'translatable';

    protected $slug_name = 'slug';

    public function rows()
    {
        return $this->morphMany(Row::class, 'rowable');
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    //Overrides for polymorphic delete
    public function forceDelete()
    {
        $deleted = parent::forceDelete();
        if ($deleted) {
            $this->translations()->delete();
            $this->rows()->delete();
        }
    }

    public function getSlugField()
    {
        return $this->slug_field ?? null;
    }

    public function getSlugName()
    {
        return $this->slug_name;
    }
}
