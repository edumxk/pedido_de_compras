<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        $suppliers = $suppliers->map(function ($supplier) {
            $supplier->hashedId = $this->createHash($supplier->id);
            return $supplier;
        });

        return view('suppliers.index', compact('suppliers'));
    }

    public function edit(string|int $hashedId)
    {
        $supplier = Supplier::find($this->decodeHash($hashedId));
        $supplier->hashedId  = $hashedId;
        return view('suppliers.edit', compact('supplier'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('suppliers.index');
    }

    public function show(string|int $hashedId)
    {
        $supplier = Supplier::find((new Hashids())->decode($hashedId)[0]);
        $supplier->hashedId  = $hashedId;
        return view('suppliers.show', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, string|int $hashedId)
    {


        // Decodificar o hashedId para obter o id real
        $id = $this->decodeHash($hashedId);

        // Encontrar o fornecedor pelo id
        $supplier = Supplier::find($id);

        // Separar os dados do fornecedor e os contatos da requisição
        $supplierData = $request->except('contacts');
        $contactsData = $request->get('contacts');

        // Atualizar o fornecedor com os dados do fornecedor
        $supplier->update($supplierData);

        // Iterar sobre os contatos da requisição
        foreach ($contactsData as $contactData) {
            // Se o id do contato for null ou vazio, criar um novo contato
            if (empty($contactData['id'])) {
                try {
                    $contactData['supplier_id'] = $supplier->id;
                    $newContact = $supplier->contacts()->create($contactData);
                    \Log::info('New contact created: ', ['contact' => $newContact]);
                } catch (\Exception $e) {
                    \Log::error('Error creating contact: ' . $e->getMessage());
                    return response()->json(['error' => 'Error creating contact: ' . $e->getMessage()], 500);
                }
            } else {
                // Se o id do contato existir, atualizar o contato existente
                $contact = $supplier->contacts()->find($contactData['id']);
                if ($contact) {
                    $contact->update($contactData);
                }
            }
        }

        // Remover os contatos que não estão na requisição
        $supplier->contacts()->whereNotIn('id', array_column($contactsData, 'id'))->delete();

        return redirect()->route('suppliers.index');
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:suppliers,id|integer'
        ]);


        $supplier = Supplier::find($request->id);

        if(!$supplier || $supplier->purchaseOrders->count() > 0)
            return redirect()->route('suppliers.index');
        else
            $supplier->delete();

        return redirect()->route('suppliers.index');
    }
}
