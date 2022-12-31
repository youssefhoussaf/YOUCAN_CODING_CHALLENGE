<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function getAll(){
        $data =  Category::all();
        return response()->json([ "data" => $data], 200);
    }

    public function getCategories(Request $req){

        $validatorArr = [
            'per_page' => 'required|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Category::select('categories.id','categories.name','categories.parent_category','c2.name as category')
            ->leftJoin('categories as c2','categories.parent_category','=','c2.id')->orderBy('categories.id','DESC')->paginate($req->per_page);

        return response()->json([ "data" => $data], 200);
        
    }

    public function addCategory(Request $req){

        $validatorArr = [
            'name' => 'required|string|max:100',
            'parent_category' => 'nullable|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $category = new Category();
        $category->name = $req->name;
        $category->parent_category = $req->parent_category;

        $check = $category->save();

        if($check){
            return response()->json(['success'=>true], 200);
        }
        else{
            return response()->json(['message'=>"Server error"], 500);
        }

    }

    public function updateCategory(Request $req){

        $validatorArr = [
            'name' => 'required|string|max:100',
            'parent_category' => 'nullable|integer',
            'id' => 'required|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $category = Category::find($req->id);

        if(!$category) return response()->json(['message'=>'category not found'], 404);

        $category->name = $req->name;
        $category->parent_category = $req->parent_category;

        $check = $category->save();

        if($check){
            return response()->json(['success'=>true], 200);
        }
        else{
            return response()->json(['message'=>"Server error"], 500);
        }

    }

    public function deleteCategory(Request $req){
        if(!$req->id) return response()->json(['message'=>'id is required'], 400);
        Category::where('id','=',$req->id)->delete();
        return response()->json(['success'=>true], 200);
    }
}
