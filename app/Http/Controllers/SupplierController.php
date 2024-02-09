<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Contact;
use App\Models\Supplier;
use GuzzleHttp\Client;
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
        $supplier->address = $this->getAddressByCnpj($supplier->cnpj);
        \Log::info('Endereço consultado em API: ', ['supplier' => $supplier->address]);
        return view('suppliers.edit', compact('supplier'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(string|int $hashedId)
    {
        $supplier = Supplier::find((new Hashids())->decode($hashedId)[0]);
        $supplier->hashedId  = $hashedId;
        $supplier->address = $this->getAddressByCnpj($supplier->cnpj);
        \Log::info('Endereço consultado em API: ', ['supplier' => $supplier->address]);
        return view('suppliers.show', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, string|int $hashedId)
    {
        \DB::enableQueryLog(); // Ativar o log de consultas
        $contactIds = [];

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

            \Log::info('Loop contact: '.$contactData['name'] , ['contact' => $contactData]);

            if (empty($contactData['id'])) {
                try {
                    $contactData['supplier_id'] = $supplier->id;
                    $newContact = $supplier->contacts()->create($contactData);
                    \Log::info('New contact created: ', ['contact' => $newContact]);
                    $contactIds[] = $newContact->id;
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
                $contactIds[] = $contact->id;
            }
        }

        if(count($contactIds) > 0)
            $supplier->contacts()->whereNotIn('id', $contactIds)->delete();

        \Log::info('SQL Query Log: ', \DB::getQueryLog()); // Registrar o log de consultas

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

    public function getAddressByCnpj(string|int $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;

        // outra api para consulta de cnpj  https://brasilapi.com.br/api/cnpj/v1/

        try {
            $request = $client->get($url);
            $response = $request->getBody();
        } catch (\Exception $e) {
            return 'Endereço não encontrado';
        }

        $data = json_decode($response, true);

        if(isset($data['status']) && $data['status'] == 'ERROR')
            return 'Endereço não encontrado';

        $adress = $data['logradouro'] . ', ' . $data['numero'] . ', ' . $data['complemento']. ', ' . $data['bairro'] . ', ' . $data['municipio'] . ' - ' . $data['uf'];
        $contact = new Contact();
        $contact->email = $data['email'];
        $contact->call = $data['telefone'];
        $contact->adress = $adress;

        return $contact;
    }
}
