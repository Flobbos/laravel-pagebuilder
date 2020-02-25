<?php

namespace Flobbos\Pagebuilder;
use Flobbos\Pagebuilder\Contracts\PagebuilderContract;
use Flobbos\Pagebuilder\Translations;
use Flobbos\Pagebuilder\Models\Row;
use Flobbos\Pagebuilder\Models\Column;
use Flobbos\Pagebuilder\Models\Translation;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;

class Pagebuilder implements PagebuilderContract{
    
    use Translations\Translatable;
    
    protected $rows,$columns,$model;
    
    public function __construct(Row $rows, Column $columns) {
        $this->rows = $rows;
        $this->columns = $columns;
    }
    
    public function get(){
        return $this->model->with([
            'rows'=>function($q){
                $q->orderBy('sorting')->with(['columns'=>function($q){
                    $q->with('translations','element_type');
                }]);
            },
            'translations'
        ])->get();
    }
    
    public function find($id){
        return $this->model->with([
            'rows'=>function($q){
                $q->orderBy('sorting')->with(['columns'=>function($q){
                    $q->with('translations','element_type');
                }]);
            },
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
        $article = $this->model->create($data);
        //Process translations
        $translation_data = $this->processTranslations($request->get('translations'));
        //Encode content
        $trans_models = $this->encodeContent($translation_data);
        //Save results
        $article->translations()->saveMany($trans_models);
        //Create rows and columns
        foreach($request->get('rows') as $row_key=>$row){
            //Create row entry
            $current_row = $article->rows()->create($row);
            //Create columns
            foreach($row['columns'] as $column_key=>$column){
                //Check if column is set
                if($column = $this->processColumn($column)){
                    $current_column = $current_row->columns()->create($column);
                    //Handle actual content
                    foreach($column['translations'] as $trans_key=>$trans){
                        if($content = $this->processContent($trans_key,$trans)){
                            $current_column->translations()->create($content);
                        }
                    }
                }
            }
        }
        return $article;
    }
    
    public function update($id, Request $request) {

        //Grab basic project
        $article = $this->model->with('rows.columns.translations')->find($id);
        //Grab request data
        $article_data = $request->except('rows','translations');
        //Update basic translations
        $this->updateTranslations(
                    $request->get('translations'),
                    $article);
        //Update basic project
        $article->update($article_data);

        //Update rows and columns
        foreach($request->get('rows') as $row_key=>$row){
            //Update existing row
            if(isset($row['id']) && $current_row = $article->rows->find($row['id'])){
    
                $current_row->update($row);
                //Run through columns
                //dd($row['columns'])
                foreach($row['columns'] as $column){
                    if(isset($column['id']) && $current_column = $current_row->columns->where('id',$column['id'])->first()){
                        //Update basic column data
                        $current_column->update($column);
                        
                        //Update column translations
                        foreach($column['translations'] as $trans_key=>$trans){
                            //Translation exists: Update
                            if(isset($trans['id']) && $current_trans = $current_column->translations->find($trans['id'])){
                                $current_trans->update($this->processContent($trans_key, $trans));
                            }
                            //No translation yet: Create
                            else{
                                //Pass empty translations
                                if($content = $this->processContent($trans_key,$trans)){
                                    $current_column->translations()->create($content);
                                }
                            }
                        }
                    }
                    else{
                        if($column = $this->processColumn($column)){
                            $current_column = $current_row->columns()->create($column);
                            foreach($column['translations'] as $trans_key=>$trans){
                                if($content = $this->processContent($trans_key,$trans)){
                                    $current_column->translations()->create($content);
                                }
                            }
                        }
                    }
                }
            }
            //Create new row
            else{
                $current_row = $article->rows()->create($row);
                //Look for columns
                foreach($row['columns'] as $column){
                    if($column = $this->processColumn($column)){
                        $current_column = $current_row->columns()->create($column);
                        foreach($column['translations'] as $trans_key=>$trans){
                            if($content = $this->processContent($trans_key,$trans)){
                                $current_column->translations()->create($content);
                            }
                        }
                    }
                }
            }
        }
        return $article;
    }
    
    public function delete($id) {
        return $this->model->find($id)->delete();
    }
    
    //Utilities
    private function processContent($trans_key,$trans){
        if(!is_null($trans) && !empty($this->processTranslations($trans))){
            return $trans;
        }
        return null;
    }
    
    private function processColumn($column){
        if((Arr::get($column,'element_type_id')) != 0){
            return $column;
        }
        return null;
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
