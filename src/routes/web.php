<?php

use Flobbos\Pagebuilder\Controllers\UploadController;
use Flobbos\Pagebuilder\Controllers\LanguageController;
use Flobbos\Pagebuilder\Controllers\ElementTypeController;
use Flobbos\Pagebuilder\Controllers\PagebuilderController;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'pagebuilder', 'as' => 'pagebuilder::'], function () {
    Route::get('/', [PagebuilderController::class, 'index'])->name('home');
    //Resource route for languages
    Route::resource('languages', LanguageController::class);
    //Resource route for elements
    Route::resource('element-types', ElementTypeController::class);
    //Upload photos
    Route::post('upload-photo', [UploadController::class, 'store'])->name('upload');
    //Delete Photos
    Route::delete('delete-photo', [UploadController::class, 'destroy'])->name('delete-photo');
    //Delete entire row
    Route::delete('delete-row', [PagebuilderController::class, 'deleteRow'])->name('delete-row');
    //Delete Column
    Route::delete('delete-column', [PagebuilderController::class, 'deleteColumn'])->name('delete-column');
});
