<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.admin.foods.index", ["foodList" => Food::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.foods.create", ["categories" => Category::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required|integer",
            "description" => "required",
            "ingredients" => "required",
            "img" => "required|max:4096|mimes:png,jpg,jpeg"
        ], [
            "required" => "You have to fill this field",
            "max" => "File must be less than 4MB",
            "mines" => "File extension must be png, jpg, jpeg",
            "integer" => "Price must be an integer"
        ]);

        $file = $request->file("img");
        $fileName = time()."_". $file->getClientOriginalName();
        $file->move(public_path("images"), $fileName);
        $food = new Food();
        $food->name = $request->name;
        $food->price = $request->price;
        $food->description = $request->description;
        $food->ingredients = $request->ingredients;
        $food->cateId = $request->cateId;
        $food->img = $fileName;
        $food->save();
        return redirect()->route("foods.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("pages.admin.foods.detail", ["food" => Food::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("pages.admin.foods.update", ["food" => Food::find($id), "categories" => Category::get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if ($request->hasFile("img")) {
            $file = $request->file("img");
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("images"), $fileName);
            if ($food->img != "") unlink("images/".$food->img);
            $food->img = $fileName;
        }
        $food->name = $request->name;
        $food->price = $request->price;
        $food->description = $request->description;
        $food->ingredients = $request->ingredients;
        $food->cateId = $request->cateId;
        $food->save();
        return redirect()->route("foods.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        unlink("images/".$food->img);
        $food->delete();
        return redirect()->route('pages.admin.foods.index');
    }
}
