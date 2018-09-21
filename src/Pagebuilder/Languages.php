<?php

namespace Flobbos\Pagebuilder;

use Flobbos\Pagebuilder\Models\Language;
use Flobbos\Pagebuilder\LanguageContract;

class Languages implements LanguageContract {
    
    public function __construct(Language $language) {
        $this->model = $language;
    }
    
    public function get(){
        return $this->model->get();
    }
    
    public function find($id){
        return $this->model->find($id);
    }
    
    public function create(array $language_data){
        return $this->model->create($language_data);
    }
    
    public function update($id, array $language_data){
        $lang = $this->find($id);
        if(is_null($lang)){
            throw new Exception('Model not found');
        }
        if($lang->update($language_data)){
            return $lang;
        }
        return false;
    }
    
    public function destroy($id){
        $lang = $this->find($id);
        return $lang->delete();
    }
}