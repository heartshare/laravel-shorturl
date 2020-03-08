<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::post('/longToShort', 'ShortUrlController@longToShort');
/*Route::get('api/{id?}', function ($id=1) {
    return response('Hello'.$id, 200);
});*/
Route::get('/{code}', 'ShortUrlController@shortToLong');

