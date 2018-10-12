<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Pagebuilder\Contracts\ElementContract;
use Flobbos\Pagebuilder\Contracts\LanguageContract; 
use Exception;

class PagebuilderController extends Controller{
    
    public function index(ElementContract $elements, LanguageContract $lang){
        return view('pagebuilder::main')->with([
            'elements' => $elements->get(),
            'languages' => $lang->get()
        ]);
    }
    
}