<?php

Route::group(['middleware'=>['web','auth'],'namespace'=>'Flobbos\Pagebuilder\Controllers','prefix'=>'pagebuilder','as'=>'pagebuilder::'], function(){
    Route::resource('languages','LanguageController');
    Route::resource('element-types', 'ElementTypeController');
    Route::resource('articles','ArticleController');
});
