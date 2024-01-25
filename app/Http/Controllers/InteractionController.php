<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{

    public function store(Request $request)
    {
        //validate the request
        $request->validate([
            'body' => 'required',
            'purchase_order_id' => 'required'
        ]);

       // dd([$request->body, $request->purchase_order_id, Auth()->id()]);
        //save the interaction in table interactions
        Interaction::create([
            'body' => $request->body,
            'purchase_order_id' => $request->purchase_order_id,
            'user_id' => Auth()->id(),
        ]);

        //redirect back
        return back();
    }

}
