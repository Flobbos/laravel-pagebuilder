<?php

namespace Flobbos\Pagebuilder;

use Flobbos\Pagebuilder\Contracts\RowColumnContract;
use Flobbos\Pagebuilder\Models\Row;
use Flobbos\Pagebuilder\Models\Column;
use Exception;

class RowColumn implements RowColumnContract{
    
    protected $rows,$columns;
    
    public function __construct(Row $rows, Column $columns) {
        $this->rows = $rows;
        $this->columns = $columns;
    }
    
    public function deleteRow($row_id) {
        $row = $this->rows->find($row_id);
        return $row->delete();
    }
    
    public function deleteColumn($column_id) {
        $column = $this->columns->find($column_id);
        return $column->delete();
    }
    
}