<?php

namespace Flobbos\Pagebuilder\Translations;

use Flobbos\Pagebuilder\Exceptions\MissingTranslationsException;
use Flobbos\Pagebuilder\Exceptions\MissingRequiredFieldsException;
use Flobbos\Pagebuilder\Exceptions\MissingTranslationNameException;
use Illuminate\Support\Arr;

trait Translatable{
    
    protected $translation_name = 'translations';
    
    /**
     * Process translation input data for saving them.
     * @param array $translations
     * @param string $trans_key translation key field name
     * @param string $language_key language identifier field
     * @return array
     */
    public function processTranslations(
            array $translations, 
            $trans_key = null, 
            $language_key = 'language_id'){
        
        $approved = [];
        
        foreach($translations as $trans){
            //Check if translation is array at and skip
            if(!is_array($trans)){
                continue;
            }
            //Check for translation key
            if(!is_null($trans_key)){
                unset($trans[$trans_key]);
            }
            if(!isset($this->required_trans) && !empty($this->filterNull($trans,$language_key))){
                $approved[] = $this->checkForSlug($trans);
            }
        }
        return $approved;
    }
    
    /**
     * Save translations to model
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $translations
     * @param string $relation_name
     * @return Model
     */
    public function saveTranslations(
            \Illuminate\Database\Eloquent\Model $model, 
            array $translations){
        
        if(empty($translations))
            throw new MissingTranslationsException;
        
        return $model->{$this->translation_name}()->saveMany($translations);
    }
    
    /**
     * 
     * @param array $arr
     * @param type $except
     * @return type
     */
    public function filterNull(array $arr, $except = null){
        if(is_null($except)){
            return array_filter($arr, function($var){
                return !is_null($var);
            });
        }
        if(!is_null($except)){
            $filtered = $this->filterNull($arr);
            if(isset($filtered[$except]) && count($filtered) == 1){
                return [];
            }
            return $filtered;
        }
    }
    
    /**
     * 
     * @param type $translations
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $translation_id
     * @param type $translation_class
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateTranslations(
            array $translations, 
            \Illuminate\Database\Eloquent\Model $model){
        //Update existing translations
        $remaining = [];
        foreach($translations as $trans){
            if(isset($trans['id']) && !is_null($trans['id'])){
                $translation = $model->translations()->where('id',$trans['id'])->first();
                //Check if parent model is available
                if(isset($this->model)){
                    //Add keys that exist with deleted values
                    foreach($this->model->translatedAttributes as $key){
                        if(!array_key_exists($key, $trans)){
                            $trans[$key] = null;
                        }
                    }
                }
                //Update translation and URL slug
                $translation->update($this->checkForSlug($trans));
            }
            else{
                $remaining[] = $trans;
            }
        }
        
        //Create new translations
        $new_translations = $this->processTranslations($remaining,true);
        //dd($new_translations);
        //die();
        if(!empty($new_translations)){
            $trans_models = $this->encodeContent($new_translations);
            $model->translations()->saveMany($trans_models);
        }
        return $model;
    }
    
    public function encodeContent($translation_data){
        $trans_models = [];
        foreach($translation_data as $trans_item){
            $trans_models[] = new \Flobbos\Pagebuilder\Models\Translation($trans_item);
        }
        return $trans_models;
    }
    
    private function generateSlug(string $name): string{
        return Str::slug($name);
    }
    
    private function checkForSlug(array $trans): array{
        //Don't use slugs
        if(!$this->model->getSlugField()){
            return $trans;
        }
        //Check if current translation contains a sluggable field
        if(array_key_exists($this->model->getSlugField(), $trans)){
            $trans[$this->model->getSlugName()] = $this->generateSlug($trans[$this->getSlugField()]);
        }
        return $trans;
    }
    
}