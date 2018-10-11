<?php

namespace Flobbos\Pagebuilder\Contracts;

interface PagebuilderContract {
    
    public function setClass($key);
    
    public function get();
    
    public function find($id);
    
    public function create(\Illuminate\Http\Request $request);
    
    public function update($id, \Illuminate\Http\Request $request);
    
    public function delete($id);
    
    public function deleteRow($row_id);
    
    public function deleteColumn($column_id);
    
}