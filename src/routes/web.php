<?php

Route::group(['middleware'=>['web','auth'],'namespace'=>'Flobbos\Pagebuilder\Controllers','prefix'=>'pagebuilder','as'=>'pagebuilder::'], function(){
    Route::get('/','PagebuilderController@index')->name('home');
    //Resource route for languages
    Route::resource('languages','LanguageController');
    //Resource route for elements
    Route::resource('element-types', 'ElementTypeController');
    //Upload photos
    Route::post('upload-photo','UploadController@store')->name('upload');
    //Delete Photos
    Route::delete('delete-photo','UploadController@destroy')->name('delete-photo');
    //Delete entire row
    Route::delete('delete-row','PagebuilderController@deleteRow')->name('delete-row');
    //Delete Column
    Route::delete('delete-column','PagebuilderController@deleteColumn')->name('delete-column');
});
