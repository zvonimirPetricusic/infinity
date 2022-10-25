<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\ItemImage;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{

    public function get()
    {
        $result = Items::get();

        return $result;

    }

    public function post()
    {
            $name       = $_FILES['file']['name'];  
            $temp_name  = $_FILES['file']['tmp_name'];  
            $location = $_SERVER['DOCUMENT_ROOT'] . "/img";   

            $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
            $settings = DB::select('SELECT id AS company_id FROM company WHERE subdomain = :subdomain LIMIT 1',  ['subdomain' => $subdomain]);
            $company_id = false;
            foreach($settings as $res){
                $company_id = $res->company_id;
            }
               
            if(move_uploaded_file($temp_name, $location. "/" .$name)){
                $insert_item = Items::insertGetId(
                    array(
                           'name'     =>   $_POST["name"], 
                           'description'   =>   $_POST["description"],
                           'price'   =>   $_POST["price"],
                           'subcategory_id'   =>   $_POST["subcategories"],
                           'color'   =>   trim($_POST["color"], "#"),
                           'size'   =>   $_POST["size"],
                           'quantity'   =>   $_POST["quantity"],
                           'company_id'   =>   $company_id
                    )
               );
               if($insert_item){
                    $insert_item_image = ItemImage::insert(
                        array(
                            'filename'  =>   $name, 
                            'item_id'   =>   $insert_item
                        )
                    );

                    if($insert_item_image){
                        return ["status" => "success"];
                    }
               }
            }

            return ["status" => "error"];
    }
}
