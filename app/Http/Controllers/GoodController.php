<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Good;
use App\GoodGroup;

class GoodController extends Controller
{
	const price_length = 12;
	const price_frac = 2;
	
	// проверка, что объект типа float
	private function isfloat($num) {
		return is_float($num) || is_numeric($num);
	}
	
	// корректность цены
	private function price_validation($price)
	{
		$pos = strpos($price, '.');
		$length = $pos === false ? strlen($price) + self::price_frac : strlen(substr($price, $pos));
		return $length <= self::price_length && GoodController::isfloat($price)  && floatval($price) > 0;
	}
	
	// сформировать сообщение об ошибке
	private function errorMessage($message)
	{
		return response()->json(['error' => $message], 200, [], JSON_UNESCAPED_UNICODE);
	}
	
	// сформировать сообщение с результатом
	private function okMessage($data)
	{
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	// добавить товар
	public function add_good(Request $request)
	{
		if(!GoodGroup::where('id', $request->input('group_id'))->exists())
			return GoodController::errorMessage($request->input('group_id') . ' group does not exist');
		
		$good = Good::where('name', 'like', $request->input('name')); // поиск товара, что был указан в параметрах
		
		// если он существует, то добавляем запись в таблицу товаров
		if (!$good->exists())
		{
			// проверяем корректность цены
			if(!GoodController::price_validation($request->input('price')))
				return GoodController::errorMessage($request->input('price') . ' is not correct(check it positive)');
			
			// создаем новый товар
			$good = new Good();
			$good->name = $request->input('name');
			$good->description = $request->input('description');
			$good->price = floatval($request->input('price'));
			
			if(!$good->save())
				return GoodController::errorMessage($good->name . ' can not be saved');
		}
			
		$good = Good::where('name', 'like', $request->input('name'))->first(); // получение ссылки на объект
				
		// проверям на наличие записи ссылок 
		if ($good->groups()->where('good_groups.id', $request->input('group_id'))->exists())
			return GoodController::errorMessage($request->input('group_id') . ' link exists');		
		
		// добвляем ссылку на группу
		$good->groups()->attach($request->input('group_id'));
		
		return GoodController::okMessage($good);
	}
	
	// получить все товары
	public function get_goods()
	{
		return GoodController::okMessage(Good::with(['groups'=> function ($query) { $query->distinct(); }])->get());
	}
	
	// получить указанные товар, которые содержат указанную группу
	public function get_goods_group_id(Request $request)
	{
		$group = GoodGroup::where('name', 'like', $request->input('name'));
		
		if (!$group->exists())
			return GoodController::errorMessage($request->input('name') . ' group does not exist');
		
		$goods = Good::whereHas('groups', function ($query) use($request) { 
													$query->where('name', 'like', $request->input('name')); 
												});
		
		return GoodController::okMessage($goods->get());
	}
	
	// получить указанный товар
	public function get_good(Request $request)
	{
		$good = Good::where('name', 'like', $request->input('name')); // поиск товара, что был указан в параметрах
		
		// проверка существования товара
		if (!$good->exists())
			return GoodController::errorMessage($request->input('name') . ' was not found');
		
		return GoodController::okMessage(Good::with(['groups'=> function ($query) { $query->distinct(); }])->where('name', 'like', $request->input('name'))->get());
	}
	
	public function update_good(Request $request)
	{
		$good = Good::where('name', 'like', $request->input('old_name')); // поиск товара, что был указан в параметрах
		
		// проверка существования товара
		if (!$good->exists())
			return GoodController::errorMessage($request->input('old_name') . ' was not found');
		
		// заменяем на другое имя и имя не используется
		if ($request->input('old_name') !== $request->input('new_name') && Good::where('name', 'like', $request->input('new_name'))->exists())
			return GoodController::errorMessage($request->input('new_name') . ' already exists');
		
		// проверяем корректность цены
		if(!GoodController::price_validation($request->input('price')))
			return GoodController::errorMessage($request->input('price') . ' is not correct(check it positive)');
		
		$good = $good->first();
		
		$good->name = $request->input('new_name');
		$good->description = $request->input('description');
		$good->price = floatval($request->input('price'));
		
		// обновляем данные
		if($good->save())
			return GoodController::okMessage($good);
		else
			return GoodController::errorMessage($good->name . ' can not be saved');
	}
	
	// удалить товар
	public function delete_good(Request $request)
	{
		$good = Good::where('name', 'like', $request->input('name')); // ищем товар
		
		// проверка наличия товара
		if (!$good->exists())
			return GoodController::errorMessage($request->input('name') . ' was not found');
		$good = $good->first();
		// удаляем товар со связями на группы
		if($good->delete()) 
			return GoodController::okMessage($good);
		else
			return GoodController::errorMessage($request->input('name') . ' field could not be removed');
		
	}
}
