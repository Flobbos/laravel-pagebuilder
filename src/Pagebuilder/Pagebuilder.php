<?php

namespace Flobbos\Pagebuilder;
use Flobbos\Pagebuilder\Contracts\PagebuilderContract;
use Flobbos\Pagebuilder\Translations;
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
    
    public function get(){
        return $this->model->with([
            'rows.columns.translations',
            'translations'
        ])->get();
    }
    
    public function find($id){
        return $this->model->with([
            'rows.columns.translations',
            'translations'
        ])->find($id);
    }
    
    public function setClass($key){
        $class = config('pagebuilder.builder_classes.'.$key);
        $this->model = new $class;
    }
    
    public function create(Request $request) {
        //Grab project data
        $data = $request->except('rows','translations');
        //Create project entry with basic translations
        $project = $this->model->create($data);
        //Process translations
        $translation_data = $this->processTranslations(json_decode($request->get('translations'),true));
        //dd($translation_data);
        foreach($translation_data as $trans_item){
            $language_id = $trans_item['language_id'];
            unset($trans_item['language_id']);
            $translated_element = [
                'language_id' => $language_id,
                'content' => json_encode($trans_item)
            ];
            $trans_models[] = new Translation($translated_element);
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
        return $this->model->find($id)->delete();
    }
    
    public function deleteRow($row_id) {
        $row = $this->rows->find($row_id);
        return $row->delete();
    }
    
    public function deleteColumn($column_id) {
        $column = $this->columns->find($column_id);
        return $column->delete();
    }
    
    //Utilities
    private function processContent($trans_key,$trans){
        if(!empty($this->processTranslations($trans))){
            return $trans;
        }
        return null;
    }
    
    private function processColumn($column){
        return $column;
    }
    
    //OVERRIDES
    
    /**
     * Filter empty request data from translations
     * @param array $arr
     * @param type $except
     * @return type
     */
    public function filterNull(array $arr, $except = null){
        if(is_null($except)){
            return array_filter($arr, function($var){
                return !is_null($var) && !empty($var);
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
    
    
}