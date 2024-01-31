<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function createHash($id) : string
    {
        $config = config('app.hashids');
        $hashids = new Hashids($config['salt'], $config['length']);
        return $hashids->encode($id);
    }

    protected function decodeHash($hashedId)  : string|int
    {
        try {
            $config = config('app.hashids');
            $hashids = new Hashids($config['salt'], $config['length']);
            return $hashids->decode($hashedId)[0];
        }catch (\Exception $e){
            abort(404);
        }
    }
}
