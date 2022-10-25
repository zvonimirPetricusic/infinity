<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;
use App\Models\Items;
use App\Models\Reservations;
use Illuminate\Support\Facades\Hash;

class ChatbotController extends Controller
{

    public function countUsers()
    {
        $result = DB::table('users')->count();

        return $result;
    }

    public function color(){

        $colors = DB::select('SELECT color AS color FROM items WHERE 1=1 GROUP BY color');

        return $colors;
    }

    public function selectedColor(){
        $items = DB::select('SELECT items.id AS id, items.name AS name, item_images.filename AS filename FROM items LEFT JOIN item_images ON items.id = item_images.item_id WHERE items.color = :color GROUP BY items.id, items.name, item_images.filename', ['color' => $_GET["color"]]);

        return $items;
    }

    public function companyContact()
    {
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];

        $result = Compamy::where('subdomain', $subdomain)->first();

        return json_encode($result->email,true);
    }

    public function price(){
        $result = Items::where('id',$_GET["item_id"])->first();

        return $result->price;
    }

    public function scrapeGoogle(){

        $search="http://www.google.com/search?q=" . $_GET["message"];

        return json_encode($search, true);
    }

    public function createUser()
    {
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];

        $result = Company::where('subdomain', $subdomain)->first();
        
        $user = User::create([
            'name' => $_GET['name'],
            'email' => $_GET['email'],
            'password' => Hash::make($_GET['password']),
            'company_id' => $result->id
        ]);

        if($user){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function checkSim(){
        $x = $_GET["x"];
        $y = $_GET["y"];
        
        $sim = similar_text($x, $y, $perc);

        echo $sim / 100; die;
    }

    public function reservation()
    {
        $item_id = $_GET["item_id"];

        $reservation = Reservations::create([
            'user_name' => $_GET['name'],
            'user_surname' => $_GET['surname'],
            'user_email' => $_GET['email'],
            'user_phone' => $_GET['phone'],
            'item_id' => $item_id
        ]);

        if($reservation){
            $items = Items::where('id', $item_id)->update(['quantity'=> DB::raw('quantity-1')]);
            if($items){
                return 1;
            }
        }else{
            return 0;
        }
    }
    
}
