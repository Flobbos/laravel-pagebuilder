<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Pagebuilder\Contracts\ElementContract;
use Flobbos\Pagebuilder\Contracts\LanguageContract;
use Flobbos\Pagebuilder\Contracts\PagebuilderContract;
use Exception;

class ArticleController extends Controller{
    
    protected $articles;

    public function __construct(PagebuilderContract $builder) {
        $this->articles = $builder;
        //Init pagebuilder model class
        $this->articles->setClass('article');
        //dd($this->articles);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pagebuilder::articles.index')->with(['articles'=>$this->articles->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LanguageContract $lang, ElementContract $element_types){
        return view('pagebuilder::articles.create')->with([
            'languages' => $lang->get(),
            'element_types' => $element_types->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            // dd($request->all());
            $article = $this->articles->create($request);
            return response()->json([
                'success'=>true,
                'return_url' => route('pagebuilder::articles.edit',$article->id)
            ],200);
            //return redirect()->route('admin.articles.index')->withMessage(trans('crud.record_created'));
        } catch (Exception $ex) {
            return response()->json(['success'=>false,'message'=>$ex->getMessage().'--'.$ex->getLine().'--'.$ex->getFile()],422);
            //return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, LanguageContract $lang, ElementContract $element_types){
        //$project = $this->articles->with('rows.columns.translations','translations')->find($id);
        //dd($project);
        return view('pagebuilder::articles.edit')->with([
            'article'=>$this->articles->find($id),
            'languages'=>$lang->get(),
            'element_types' => $element_types->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        try{
            //dd(json_decode($request->get('translations')));
            //dd(json_decode($request->get('rows')));
            $this->articles->update($id, $request);
            //return redirect()->route('admin.articles.index')->withMessage(trans('crud.record_updated'));
            //throw new Exception('Bix!');
            return response()->json([
                'success'=>true,
                'return_url'=>route('pagebuilder::articles.edit',$id)
            ],200);
        } catch (Exception $ex) {
            //return redirect()->back()->withInput()->withErrors($ex->getMessage());
            return response()->json(['success'=>false,'message'=>$ex->getMessage().' --- '.$ex->getLine().' ---- '.$ex->getFile()],422);
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
            $this->articles->delete($id);
            return redirect()->route('pagebuilder::articles.index')->withMessage(trans('pagebuilder::crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('pagebuilder::articles.index')->withErrors($ex->getMessage());
        }
    }
    
    }
