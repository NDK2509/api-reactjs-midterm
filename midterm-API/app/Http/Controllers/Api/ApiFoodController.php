<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodCollection;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiFoodController extends Controller
{
    public function all(){
        $foods = Food::get();
        return $foods == null ? ["error"=>"no data", "status"=>"fail"] : new FoodCollection($foods);
    }
    public function get($id){
        $food = Food::find($id);
        return $food == null ? ["error" => "can't find this food", "status" => "fail"] : new FoodResource($food);
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(), [
            "img" => "required|image|max:2048",
            "name" => "required",
            "price" => "required|integer",
            "description" => "required",
            "ingredients" => "required",
            "cateId" => "required"
        ]);
        if ($validator -> fails()){
            return ["error" => $validator -> errors(), "status" => "fail"];
        }
        try {

            $imgFile = $req->file("img");
            $imgName = time() . "_" . $imgFile->getClientOriginalName();
            $imgFile->move(public_path("images"), $imgName);
            $food = new Food();
            $food->name = $req->name;
            $food->price = $req->price;
            $food->img = $imgName;
            $food->description = $req->description;
            $food->ingredients = $req->ingredients;
            $food->created_at = date_create();
            $food->save();

            return ["error" => "", "status" => "created", "data" => $food];
        } catch (Exception $e) {
            return ["error" => $e->getMessage(), "status" => "fail"];
        }
    }
    public function update(Request $req, $id){
        $validator = Validator::make($req->all(), [
            "img" => "image|max:2048",
            "name" => "required",
            "price" => "required|integer",
            "description" => "required",
            "ingredients" => "required",
            "cateId" => "required"
        ]);
        if ($validator->fails()) {
            return ["error" => $validator->errors(), "status" => "fail"];
        }
        $food = Food::find($id);
        try {
            if($req->hasFile("img")){
                $imgFile = $req->file("img");
                $imgName = time() . "_" . $imgFile->getClientOriginalName();
                $imgFile->move(public_path("images"), $imgName);
                if (file_exists("/images/".$food->img)) unlink("/images/" . $food->img);
            }
            $food = new Food();
            $food->name = $req->name;
            $food->price = $req->price;
            $food->description = $req->description;
            $food->ingredients = $req->ingredients;
            $food->created_at = date_create();
            $food->save();

            return ["error" => "", "status" => "created", "data" => $food];
        } catch (Exception $e) {
            return ["error" => $e->getMessage(), "status" => "fail"];
        }

    }
    public function delete($id){
        $food = Food::find($id);
        try {
            if ($food == null) {
                return["error" => "can't find this food", "status" =>"fails"];
            }
            if (file_exists("/images/".$food->img)) unlink("/images/".$food->img);
            $food->delete();
        }catch(Exception $e){
            return ["error"=>$e->getMessage(), "status"=>"fail"];
        }
    }
    public function seerch($name = null, $priceFrom = null, $priceTo = null) {

    }
}
