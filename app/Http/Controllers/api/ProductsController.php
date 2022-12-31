<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function getProducts(Request $req){

        $validatorArr = [
            'per_page' => 'required|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Product::select('products.id','products.name','products.description','products.price','products.category_id','categories.name as category','products.image','products.created_at')
            ->join('categories','products.category_id','=','categories.id')->orderBy('products.created_at','DESC')->paginate($req->per_page);

        return response()->json([ "data" => $data], 200);
        
    }

    public function addProduct(Request $req){

        $validatorArr = [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $product = new Product();
        $product->name = $req->name;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->category_id = $req->category_id;
        $product->image = $req->image??null;

        $check = $product->save();

        if($check){
            return response()->json(['success'=>true], 200);
        }
        else{
            return response()->json(['message'=>"Server error"], 500);
        }

    }

    public function updateProduct(Request $req){

        $validatorArr = [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'id' => 'required|integer',
        ];
        
        // validate request data
        $validator = Validator::make($req->all(), $validatorArr);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $product = Product::find($req->id);

        if(!$product) return response()->json(['message'=>'product not found'], 404);

        $product->name = $req->name;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->category_id = $req->category_id;
        $product->image = $req->image??null;

        $check = $product->save();

        if($check){
            return response()->json(['success'=>true], 200);
        }
        else{
            return response()->json(['message'=>"Server error"], 500);
        }

    }

    public function deleteProduct(Request $req){
        if(!$req->id) return response()->json(['message'=>'id is required'], 400);
        Product::where('id','=',$req->id)->delete();
        return response()->json(['success'=>true], 200);
    }
}
