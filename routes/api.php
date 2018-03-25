<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/good_groups/add','GoodGroupController@add_good_group'); // 1. Метод для создания товарной группы
Route::get('/good_groups','GoodGroupController@get_good_groups'); // 2. Метод для получения списка товарных групп
Route::put('/good_groups/update','GoodGroupController@update_good_group'); // 3. Метод для обновления товарной группы
Route::delete('/good_groups/delete','GoodGroupController@delete_good_group'); // 4. Метод для удаления товарной группы
Route::post('/goods/add','GoodController@add_good'); // 5. Метод для создания товара.
Route::get('/goods','GoodController@get_goods'); // 6. Метод для получения всех товаров.
Route::get('/goods/good','GoodController@get_good'); // 7. Метод для получения конкретного товара
Route::get('/goods/group','GoodController@get_goods_group_id'); // 8. Метод для получения товаров конкретной товарной группы
Route::put('/goods/update','GoodController@update_good'); // 9. Метод для обновления данных товара
Route::delete('/goods/delete','GoodController@delete_good'); // 10. Метод для удаления товара



