<?php

namespace Flobbos\Pagebuilder;

interface PagebuilderContract {
    
    public function create(\Illuminate\Http\Request $request);
    
    public function update($id, \Illuminate\Http\Request $request);
    
    public function delete($id);
    
}