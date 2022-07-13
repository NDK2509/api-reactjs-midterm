<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $foodList = Food::get()->toArray();
        $cateList = Category::get();
        return view("pages.user.index", compact("foodList", "cateList"));
    }
    public function detail($id) {
        return view("pages.user.foods.detail", ["food" => Food::find($id)]);
    }
}
