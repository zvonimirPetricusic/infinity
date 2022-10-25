<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\Subcategories;
use Illuminate\Support\Facades\DB;

class SubcategoriesController extends Controller
{

    public function get()
    {

        if(isset($_GET["id"])){
            $result = Subcategories::select(DB::raw("subcategories.id, subcategories.name, subcategories.description, categories.name as category"))
            ->join('categories','categories.id','=','subcategories.category_id')
            ->where('subcategories.category_id', $_GET["id"])->get(); 
        }else{
            $result = Subcategories::select(DB::raw("subcategories.id, subcategories.name, subcategories.description, categories.name as category"))
            ->join('categories','categories.id','=','subcategories.category_id')
            ->get();
        }

        return $result;
    }

    public function post()
    {

        $insert = Subcategories::insert(
            array(
                   'name'     =>   $_POST["name"], 
                   'description'   =>   $_POST["description"],
                   'category_id'   =>   $_POST["categories"],
            )
       );

       if($insert){
           return ["status" => "success"];
       }

       return ["status" => "error"];
    }
}
