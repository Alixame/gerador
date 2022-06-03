<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Gerador extends Controller
{

    public function index(){
        return view('home');
    }

    public function gerar(Request $request){

        return response()->json($request->all());

    }
}
