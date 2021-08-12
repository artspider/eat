<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kitchen;

class KitchenController extends Controller
{
    //
    public function index()
    {
        //$recipesInKitchen = Kitchen::where('qtyleft','>',0)->get();        
        return view('kitchen.list',['recipes' => Kitchen::where('qtyleft','>',0)->get()]);
    }
}
