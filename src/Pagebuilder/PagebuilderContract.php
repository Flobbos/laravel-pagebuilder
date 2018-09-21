<?php

namespace Flobbos\Pagebuilder;

interface PagebuilderContract {
    
    public function create(\Illuminate\Http\Request $request);
    
    public function udpate(\Illuminate\Http\Request $request);
    
    public function delete($id);
    
}