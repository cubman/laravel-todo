<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\GoodGroup;
use App\Listing;

class GoodGroupController extends Controller
{	
	// есть ли группа в списке
	private function fieldExist($name) {
		return GoodGroup::where('name', $name)->exists();
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
	
	// добавить группу
	public function add_good_group(Request $request)
	{
		// цдостоверяемся, что группы нет
		if (GoodGroupController::fieldExist($request->input('name')))
			return GoodGroupController::errorMessage($request->input('name') . ' field exist');
			//return response()->json(['error' => $request->input('name') . ' field exist'], JSON_UNESCAPED_UNICODE);
		
		// создание новой группы
		$good_group = new GoodGroup();
		
        $good_group->name = $request->input('name');
 
        if($good_group->save()) 
			return GoodGroupController::okMessage($good_group);
		else
			return GoodGroupController::errorMessage($request->input('name') . ' field could not be saved');
	}
	
	// получить полный перечень групп
	public function get_good_groups(Request $request)
    {
		return GoodGroupController::okMessage(GoodGroup::withCount('goods')->get());
    }
	
	// добавить группу
	public function update_good_group(Request $request)
	{
		// проверка наличия группы
		if(!GoodGroupController::fieldExist($request->input('old_name')))
			return GoodGroupController::errorMessage($request->input('old_name') . ' does not exist');
		
		// замена на несуществующее название
		if(GoodGroupController::fieldExist($request->input('new_name')))
			return GoodGroupController::errorMessage($request->input('new_name') . ' exists');
		
		// поиск объекта замены
		$good_group = GoodGroup::where('name', $request->input('old_name'))->first();

        $good_group->name = $request->input('new_name');
 
        if($good_group->save()) 
			return GoodGroupController::okMessage($good_group);
		else
			return GoodGroupController::errorMessage($request->input('new_name') . ' field could not be saved');
	}
		
	// удалить группу
	public function delete_good_group(Request $request)
	{
		if(!GoodGroupController::fieldExist($request->input('name')))
			return GoodGroupController::errorMessage($request->input('name') . ' does not exist');
		
		// логику удаления
		$good_group = GoodGroup::where('name', $request->input('name'))->first();	

		if($good_group->goods()->count() != 0)
			return GoodGroupController::errorMessage($good_group->name . ' has good linqs');
		
		if($good_group->delete()) 
			return GoodGroupController::okMessage($good_group);
		else
			return GoodGroupController::errorMessage($request->input('new_name') . 'field could not be removed');
		
	}
}
