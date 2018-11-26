<?php

namespace Flobbos\Pagebuilder\Contracts;

interface RowColumnContract {
    
    public function deleteRow($row_id);
    
    public function deleteColumn($column_id);
    
}