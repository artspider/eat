<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.list',['dishes' => Dish::all()]);
    }

    public function create()
    {
        return view('dishes.create');
    }

    public function store()
    {
        /* request()->validate([
            'name' => 'required|min:5'
        ]); */
        return request()->all();
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
        public function destroy($id)
        {
            dd('destroy');
        }
}
