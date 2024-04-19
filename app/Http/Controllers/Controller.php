<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = [];
        $message = '';
        $interactionUserIds = $purchase_order->interactions
            ->pluck('user_id') // Extrai todos os user_id das interações
            ->unique(); // Remove quaisquer duplicatas
        $userId = $purchase_order->user_id;
        $interactionUserIds[] = $userId;

        //getusers admin
        $adminUser = User::where('is_admin', 1)
            ->get('id');

        //remove admin user from interactionUserIds
        $interactionUserIds = $interactionUserIds->diff($adminUser)->unique();



        if($purchase_order->status == 'opened' || $purchase_order->status == 'rejected')
            $users = User::where('is_admin', 1)
                ->orWhere('id','in', $interactionUserIds)
                ->get()->unique();
        if($purchase_order->status == 'provision')
            $users = User::where('is_financial', 1)
                ->orWhere('is_buyer', 1)
                ->get()->unique();
        if($purchase_order->status == 'approved')
            $users = User::where('id','in', $interactionUserIds)
                ->get()->unique();

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
