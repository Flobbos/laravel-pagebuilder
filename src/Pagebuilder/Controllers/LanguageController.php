<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Pagebuilder\Contracts\LanguageContract;
use Exception;

class LanguageController extends Controller{
    
    protected $language;

    public function __construct(LanguageContract $language) {
        $this->language = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pagebuilder::languages.index')->with(['languages'=>$this->language->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('pagebuilder::languages.create');
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
            $this->language->create($request->all());
            return redirect()->route('pagebuilder::languages.index')->withMessage(trans('pagebuilder::crud.record_created'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view('pagebuilder::languages.show')->with(['language'=>$this->language->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('pagebuilder::languages.edit')->with(['language'=>$this->language->find($id)]);
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
            $this->language->update($id, $request->all());
            return redirect()->route('pagebuilder::languages.index')->withMessage(trans('pagebuilder::crud.record_updated'));
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
            $this->language->delete($id);
            return redirect()->route('pagebuilder::languages.index')->withMessage(trans('pagebuilder::crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('pagebuilder::languages.index')->withErrors($ex->getMessage());
        }
    }
}

