<?php

namespace Flobbos\Pagebuilder\Uploads;

trait Uploadable {
    
    /**
     * Handle a file upload
     * @param \Illuminate\Http\Request $request
     * @param type $fieldname
     * @param type $folder
     * @param type $storage_disk
     * @return string filename
     */
    public function handleUpload(
            \Illuminate\Http\Request $request, 
            $fieldname = 'photo', 
            $folder = 'images', 
            $storage_disk = 'public', 
            $randomize = true){
        if(is_null($request->file($fieldname)) || !$request->file($fieldname)->isValid()){
            throw new \Exception(trans('crud.invalid_file_upload'));
        }
        //Get filename
        $basename = basename($request->file($fieldname)->getClientOriginalName(),'.'.$request->file($fieldname)->getClientOriginalExtension());
        if($randomize){
            $filename = uniqid().'_'.str_slug($basename).'.'.$request->file($fieldname)->getClientOriginalExtension();
        }
        else{
            $filename = str_slug($basename).'.'.$request->file($fieldname)->getClientOriginalExtension();
        }
        //Move file to location
        $request->file($fieldname)->storeAs($folder,$filename,$storage_disk);
        return $filename;
    }
    
}