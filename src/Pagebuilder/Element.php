<?php

namespace Flobbos\Pagebuilder;
use Flobbos\Pagebuilder\ElementContract;
use Flobbos\Pagebuilder\Models\ElementType;
use Exception;

class Element implements ElementContract{
    
    protected $model;
    
    public function __construct(ElementType $element_type) {
        $this->model = $element_type;
    }
    
    public function get() {
        return $this->model->get();
    }
    
    public function find($id) {
        return $this->model->find($id);
    }
    
    public function create(array $element_data) {
        return $this->model->create($element_data);
    }
    
    public function upate($id, array $element_data) {
        $element = $this->find($id);
        if(is_null($element)){
            throw new Exception('Model not found');
        }
        if($element->update($element_data)){
            return $element;
        }
        return false;
    }
    
    public function destroy($id) {
        $element = $this->find($id);
        return $element->delete();
    }
}