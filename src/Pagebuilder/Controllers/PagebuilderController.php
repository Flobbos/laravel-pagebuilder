<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Pagebuilder\Contracts\ElementContract;
use Flobbos\Pagebuilder\Contracts\LanguageContract;
use Flobbos\Pagebuilder\Contracts\RowColumnContract;
use Exception;

class PagebuilderController extends Controller
{

    public function index(ElementContract $elements, LanguageContract $lang)
    {
        return view('pagebuilder::main')->with([
            'elements' => $elements->get(),
            'languages' => $lang->get()
        ]);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function deleteRow(Request $request, RowColumnContract $rows)
    {
        try {
            $rows->deleteRow($request->get('id'));
            return response()->json(['success' => true], 200);
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function deleteColumn(Request $request, RowColumnContract $rows)
    {
        try {
            $rows->deleteColumn($request->get('id'));
            return response()->json(['success' => true], 200);
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }
}
