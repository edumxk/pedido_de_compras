<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteractionController extends Controller
{

    public function store(Request $request, string|int $id)
    {
        dd($request->all());
    }

}
