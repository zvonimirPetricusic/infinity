<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{

    public function get()
    {
        $result = Categories::get();

        return $result;

    }

    public function post()
    {

        $insert = Categories::insert(
            array(
                   'name'     =>   $_POST["name"], 
                   'description'   =>   $_POST["description"],
                   'color'   =>   $_POST["color"],
            )
       );

       if($insert){
           return ["status" => "success"];
       }

       return ["status" => "error"];
    }
}
