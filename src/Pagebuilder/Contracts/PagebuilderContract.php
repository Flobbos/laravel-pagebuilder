<?php

namespace Flobbos\Pagebuilder\Contracts;

interface PagebuilderContract {
    
    public function setClass($key);
    
    public function create(\Illuminate\Http\Request $request);
    
    public function update($id, \Illuminate\Http\Request $request);
    
    public function delete($id);
    
}