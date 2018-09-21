<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Pagebuilder\ElementContract;
use Exception;

class ElementTypeController extends Controller{
    
    protected $element_types;

    public function __construct(ElementContract $element_types) {
        $this->element_types = $element_types;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pagebuilder::element-types.index')->with(['element_types'=>$this->element_types->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('pagebuilder::element-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, []);
        
        try{
            $this->element_types->create($request->all());
            return redirect()->route('admin.element-types.index')->withMessage(trans('crud.record_created'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('pagebuilder::element-types.edit')->with(['element_type'=>$this->element_types->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, []);
        
        try{
            $this->element_types->update($id, $request->all());
            return redirect()->route('admin.element-types.index')->withMessage(trans('crud.record_updated'));
        } catch (Exception $ex) {
            return redirect()->back()->withInput()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $this->element_types->delete($id);
            return redirect()->route('admin.element-types.index')->withMessage(trans('crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('admin.element-types.index')->withErrors($ex->getMessage());
        }
    }
}

