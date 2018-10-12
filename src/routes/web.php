<?php

Route::group(['middleware'=>['web','auth'],'namespace'=>'Flobbos\Pagebuilder\Controllers','prefix'=>'pagebuilder','as'=>'pagebuilder::'], function(){
    Route::get('/','PagebuilderController@index')->name('home');
    Route::resource('languages','LanguageController');
    Route::resource('element-types', 'ElementTypeController');
    Route::post('upload','UploadController@store')->name('upload');
    Route::delete('delete-photo','UploadController@destroy')->name('delete-photo');
    Route::resource('articles','ArticleController');
});
