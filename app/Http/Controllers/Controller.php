<?php

namespace App\Http\Controllers;

use App\Models\Purchase_order;
use Hashids\Hashids;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyOrder;

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

    protected function sendEmail($purchase_order, $id)
    {

        //get name and email of is_admin, is_buyer and is_financial users of Auth registered
        $users = Auth::getUser()->where('is_admin', 1)->orWhere('is_buyer', 1)->get();

        $data = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'from_name' => 'Kokar Tintas',
            'to' => new Address($purchase_order->user->email, $purchase_order->user->name),
            'subject' => 'Ordem de Compra N° '.$purchase_order->id.' - '.$purchase_order->purchase_subject,
            'message' => $purchase_order->interactions->find($id)->body,
            'users' => $users,
            'name' => $purchase_order->interactions->find($id)->user->name,
            'id' => $purchase_order->id,
        ];

        $email = new NotifyOrder($data);

        return Mail::to($data['to'])->send($email);
    }
}
