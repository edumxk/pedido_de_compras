<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateOrderRequest;
use App\Models\Interaction;
use App\Models\Purchase_order;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        //get all purchase_orders
        $purchase_orders = Purchase_order::query();

        // Filter by subject and description
        if ($request->has('subject_description')) {
            $purchase_orders->where(function ($query) use ($request) {
                $query->where('purchase_subject', 'like', '%' . $request->subject_description . '%')
                    ->orWhere('description', 'like', '%' . $request->subject_description . '%');
            });
        }

        // Filter by department id
        if ($request->has('department_id') && $request->department_id != '') {
            $purchase_orders->where('department_id', $request->department_id);
        }

        // Filter by user name
        if ($request->has('user_name')) {
            $purchase_orders->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        $purchase_orders = $purchase_orders->get();

        $purchase_orders = $purchase_orders->map(function ($purchase_order) {
            $purchase_order->hashedId = $this->createHash($purchase_order->id);
            return $purchase_order;
        });

        // Get all departments
        $departments = Department::all();

        return view('purchase_orders.index', compact('purchase_orders', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('purchase_orders.create', compact('departments', 'positions'));
    }

    public function store(CreateUpdateOrderRequest $request)
    {
        try {
            Purchase_order::create([
                'purchase_subject' => $request->purchase_subject,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'department_id' => $request->department_id,
            ]);
            \Log::info('Criando ordem de compras. User: ' . auth()->id());
        } catch (\Exception $e) {
            \Log::info('error store purchase order: ' . $e->getMessage());
            return back()->with('error', 'Erro ao criar ordem de compra');
        }

        try {
            $ordemCompra = Purchase_order::get()->last();
            $this->sendEmail($ordemCompra);
            \Log::info('Email enviado com sucesso. user: ' . auth()->id());
        }catch (\Exception $e){
            \Log::info('error send email: '. $e->getMessage());
            return back()->with('error', 'Erro ao enviar email');
        }
        //redirect to purchase_orders page
        \Log::info('Ordem de Compra Criada com Sucesso. user: ' . auth()->id());
        return redirect('/purchase_orders')->with('success', 'Ordem de Compra Criada com Sucesso');
    }

    public function show(string|int $hashedId)
    {
        //verifica se é o criador ou se é admin ou comprador ou financeiro.
        if(auth()->id() != Purchase_order::findOrFail($this->decodeHash($hashedId))->user_id && auth()->user()->is_admin != 1 && auth()->user()->is_buyer != 1 && auth()->user()->is_financial != 1){
            return redirect('/purchase_orders')->with('error', 'Você não tem permissão para acessar essa página');
        }

        //get the purchase_order
        $purchase_order = Purchase_order::findOrFail($this->decodeHash($hashedId));
        $purchase_order->hashedId = $this->createHash($purchase_order->id);
        $departments = Department::all();

        $purchase_order->budgets = $purchase_order->budgets->map(function ($budget) {
            $budget->hashedId = $this->createHash($budget->id);
            return $budget;
        });

        try{
            //check if payments is not empty
            if($purchase_order->budgets()->where('status', 'approved')->get()->isEmpty() && $purchase_order->status == 'provision'){
                \Log::info('Budget not approved in purchase order: '. $purchase_order->id . ' status: '. $purchase_order->status);
                return back()->with('error', 'Orçamento: ' .$purchase_order->id. ' não aprovado, status: ' .$purchase_order->status. '. Envie esse erro ao T.I.');
            }

        }catch (\Exception $e){
            \Log::info('error interaction: '. $e->getMessage());
            return back()->with('error', 'Error creating interaction');
        }

        return view('purchase_orders.show', compact('purchase_order', 'departments'));
    }

    public function update(CreateUpdateOrderRequest $request, string|int $hashedId)
    {
        $purchase_order = Purchase_order::findOrFail($this->decodeHash($hashedId));

        $purchase_order->update([
            'purchase_subject' => $request->purchase_subject,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'department_id' => $request->department_id,
        ]);

        try{
            $this->sendEmail($purchase_order);
        }catch (\Exception $e){
            \Log::info('error send email: '. $e->getMessage());
            return back()->with('error', 'Error sending email');
        }
        \Log::info('Ordem de Compra Atualizada com Sucesso. N°' . $purchase_order->id. ' status: ' .$purchase_order->status . ' user: ' . auth()->id());
        //refresh the page with message success or error
        return redirect()->back()->with('success', 'Purchase Order Updated Successfully');
    }

    public function approve(Request $request)
    {
        if(Auth()->user()->is_admin == 1){
            //validate the request
            $request->validate([
                'purchase_order_id' => 'required|integer',
                'status' => 'required|string',
            ]);

            $message = 'Ordem de compra ' . __($request->status.'_f'). " com sucesso! \n" .$request->body;
            //save new status
            Interaction::create([
                'purchase_order_id' => $request->purchase_order_id,
                'body' =>  $message,
                'user_id' => auth()->id(),
            ]);

            //update the purchase_order status
            $purchase_order = Purchase_order::findOrFail($request->purchase_order_id);

            $purchase_order->update([
                'status' => $request->status,
            ]);

            try {
                $this->sendEmail($purchase_order, $purchase_order->interactions->last()->id);
            }catch (\Exception $e){
                \Log::info('error send email: '. $e->getMessage());
                return back()->with('error', 'Error sending email');
            }

            //refresh the page with message success or error
            return redirect()->back()->with('success', 'Purchase Order ' .__($request->status). ' Successfully');

        }else{
            return redirect()->back()->with('error', 'You are not authorized to perform this action');
        }
    }
}
