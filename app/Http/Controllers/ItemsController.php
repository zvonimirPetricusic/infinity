<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Items;
use App\Models\ItemImage;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Categories::get();
        $items = Items::select(DB::raw('items.id, items.name as name, items.description, items.price, items.subcategory_id, subcategories.name as category, item_images.filename'))
                        ->join('subcategories','subcategories.id','=','items.subcategory_id')
                        ->join('item_images','item_images.item_id','=','items.id')->get();



        return view('admin/items')->with('categories', $categories)->with('items', $items);
    }

}
