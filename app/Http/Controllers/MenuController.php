<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $r) {
        return view('menuAdmin.select');
    }

    public function manage(Request $r, $id) {
        $restaurant = Restaurant::where(['key' => $id])->first();
        return view('menuAdmin.list', compact('restaurant'));
    }

}
