<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyOrder;
use Illuminate\Support\Facades\App;

App::setLocale('pt');
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

    protected function sendEmail($purchase_order, $id = null, $attachment = null)
    {
        $message = '';
        $name = '';
        if($purchase_order->status == 'opened' || $purchase_order->status == 'rejected')
            $users = Auth::getUser()->where('is_admin', 1)
                ->orWhere('id', $purchase_order->user_id)
                ->orWhere('id', 'in', $purchase_order->interactions->get('user_id'))
                ->get();
        else
            $users = Auth::getUser()->where('is_buyer', 1)
                ->orWhere('id', $purchase_order->user_id)
                ->orWhere('id', 'in', $purchase_order->interactions->get('user_id'))
                ->get();

        if($id == null && $attachment == null) {
            $message = $purchase_order->description;
            $name = $purchase_order->user->name;
        }elseif($attachment != null){
            $message .= 'Novo anexo: '. $attachment->file_extension;
            $name = Auth::user()->name;
        }else{
            $message = $purchase_order->interactions->find($id)->body;
            $name = $purchase_order->interactions->find($id)->user->name;
        }


        $data = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'from_name' => 'Kokar Tintas',
            'to' => new Address($purchase_order->user->email, $purchase_order->user->name),
            'subject' => 'Ordem de Compra N° '.$purchase_order->id.' - '.$purchase_order->purchase_subject,
            'message' => $message,
            'users' => $users,
            'name' => $name,
            'id' => $purchase_order->id,
        ];

        $email = new NotifyOrder($data);

        return Mail::to($data['to'])->send($email);
    }
}
