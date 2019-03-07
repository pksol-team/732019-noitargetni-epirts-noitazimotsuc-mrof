<?php
Route::group(['prefix' => 'designer'], function () {
    Route::get('/','DesignerController@index');
    Route::post('/subject','DesignerController@saveSubject');
    Route::get('/subject/{subject}','DesignerController@getSubject');
    Route::delete('/subject/{subject}','DesignerController@deleteSubject');
    Route::post('/document','DesignerController@saveDocument');
    Route::get('/document/{document}','DesignerController@getDocument');
    Route::delete('/document/{document}','DesignerController@deleteSubject');
});