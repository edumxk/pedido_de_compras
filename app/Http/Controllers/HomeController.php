<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function setDarkMode(Request $request)
    {
        if( session('dark_mode') !== $request->session()->get('dark_mode') ){
            $request->session()->put('dark_mode', $request->input('dark_mode'));
            return response()->json(['success' => true], 201);
        }else
            $request->session()->put('dark_mode', $request->input('dark_mode'));
        return response()->json(['success' => true], 200);
    }

}
