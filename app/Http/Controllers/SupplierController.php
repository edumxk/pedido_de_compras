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

        return view('suppliers.edit', compact('supplier'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cnpj' => 'required|unique:suppliers,cnpj|min:14|max:14',
            'fantasy_name' => 'required|min:6|max:255',
            'company_name' => 'required|min:6|max:255',
            'address' => 'required|min:6|max:255',
            'contacts' => 'required|array',
            'contacts.*.name' => 'required',
            'contacts.*.email' => 'required|email',
            'contacts.*.call' => 'required',
            'contacts.*.whatsapp' => 'required',
        ]);

        // Separar os dados do fornecedor e os contatos da requisição
        $supplierData = $request->except('contacts');
        $contactsData = $request->get('contacts');

        $supplier = Supplier::create($supplierData);

        foreach ($contactsData as $contactData) {

            $contactData['supplier_id'] = $supplier->id;
            $newContact = $supplier->contacts()->create($contactData);
            \Log::info('New contact created: ', ['contact' => $newContact]);
        }

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
        $url1 = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;
        $url2 = "https://brasilapi.com.br/api/cnpj/v1/" . $cnpj;

        // outra api para consulta de cnpj  https://brasilapi.com.br/api/cnpj/v1/
        try {
            $request = $client->get($url1);
            $response = $request->getBody();
        } catch (\Exception $e) {
            try {
                $request = $client->get($url2);
                $response = $request->getBody();
            } catch (\Exception $e) {
                return 'CNPJ não encontrado';
            }

        }

        $data = json_decode($response, true);

        if(isset($data['status']) && $data['status'] == 'ERROR')
            return 'Endereço não encontrado';

        $adress = $data['logradouro'] . ', ' . $data['numero'] . ', ' . $data['complemento']. ', ' . $data['bairro'] . ', ' . $data['municipio'] . ' - ' . $data['uf'];
        $contact = new Contact();
        $contact->email = $data['email'];
        $contact->call = $data['telefone'];
        $contact->endereco = $adress;

        return $contact;
    }

    public function getAllByCnpj(string|int $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $client = new Client(); //GuzzleHttp\Client
        $url1 = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;
        $url2 = "https://brasilapi.com.br/api/cnpj/v1/" . $cnpj;


        try {
            $request = $client->get($url1);
            $response = $request->getBody();
        } catch (\Exception $e) {
            try {
                $request = $client->get($url2);
                $response = $request->getBody();
            } catch (\Exception $e) {
                return 'CNPJ não encontrado';
            }

        }

        $data = json_decode($response, true);

        if(isset($data['status']) && $data['status'] == 'ERROR')
            return 'CNPJ não encontrado';

        $adress = $data['logradouro'] . ', ' . $data['numero'] . ', ' . $data['complemento']. ', ' . $data['bairro'] . ', ' . $data['municipio'] . ' - ' . $data['uf'];

        $data['endereco'] = $adress;

        if(!isset($data['razao_social'])){
            $data['razao_social'] = $data['nome'];
            $data['nome_fantasia'] = $data['fantasia'];
        }

        return $data;

    }
}
