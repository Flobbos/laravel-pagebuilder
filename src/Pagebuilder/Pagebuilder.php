<?php

namespace Flobbos\Pagebuilder;
use Flobbos\Pagebuilder\PagebuilderContract;
use Flobbos\Crudable\Translations;
use Flobbos\Pagebuilder\Models\Row;
use Flobbos\Pagebuilder\Models\Column;
use Flobbos\Pagebuilder\Models\Translation;
use Illuminate\Http\Request;
use Exception;

class Pagebuilder implements PagebuilderContract{
    
    use Translations\Translatable;
    
    protected $rows,$columns,$model;
    protected $translation_name = 'translations';
    
    public function __construct(Row $rows, Column $columns) {
        $this->rows = $rows;
        $this->columns = $columns;
    }
    
    public function setClass($key){
        $this->model = config('pagebuilder.builder_classes.'.$key);
    }
    
    public function create(Request $request) {
        //Grab project data
        $data = $request->except('rows','translations');
        //Create project entry with basic translations
        $project = $this->model->create($data);
        //Process translations
        $translation_data = $this->processTranslations(json_decode($request->get('translations'),true));
        foreach($trans_items as $trans_item){
            $trans_models[] = new Translation($trans_item);
        }
        $project->translations()->saveMany($trans_models);
        //Create rows and columns
        foreach(json_decode($request->get('rows'),true) as $row_key=>$row){
            //Create row entry
            $current_row = $project->rows()->create($row);
            //Create columns
            foreach($row['columns'] as $column_key=>$column){
                //Check for file upload
                $current_column = $current_row->columns()->create($this->processColumn($column));
                //Handle actual content
                foreach($column['translations'] as $trans_key=>$trans){
                    if($content = $this->processContent($trans_key,$trans)){
                        $current_column->translations()->create($content);
                    }
                }
            }
        }
        return $project;
    }
    
    public function update($id, Request $request) {
        ;
    }
    
    public function delete($id) {
        ;
    }
    
    
    
}