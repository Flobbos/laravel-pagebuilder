<?php

namespace Flobbos\Pagebuilder;

interface LanguageContract{
    
    public function get();
    
    public function find($id);
    
    public function create(array $language_data);
    
    public function update($id, array $element_data);
    
    public function destroy($id);
    
}

