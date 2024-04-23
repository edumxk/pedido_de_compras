<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Contact;
use App\Models\Supplier;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
{
    public function index()
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para acessar fornecedores');

        $suppliers = Supplier::all();
        $suppliers = $suppliers->map(function ($supplier) {
            $supplier->hashedId = $this->createHash($supplier->id);
            return $supplier;
        });

        return view('suppliers.index', compact('suppliers'));
    }

    public function edit(string|int $hashedId)

    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para editar fornecedores');

        $supplier = Supplier::find($this->decodeHash($hashedId));
        $supplier->hashedId  = $hashedId;

        return view('suppliers.edit', compact('supplier'));
    }

    public function create()
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para criar fornecedores');
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para criar fornecedores');

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
        ],['cnpj.unique' => 'CNPJ já cadastrado',
            'cnpj.min' => 'CNPJ inválido, deve conter 14 digitos, ex: 17832268000192',
            'cnpj.max' => 'CNPJ inválido, deve conter 14 digitos, ex: 17832268000192',
                'fantasy_name.required' => 'Nome fantasia é obrigatório',
                'fantasy_name.min' => 'Nome fantasia deve conter no mínimo 6 caracteres',
                'fantasy_name.max' => 'Nome fantasia deve conter no máximo 255 caracteres',
                'company_name.required' => 'Razão social é obrigatório',
                'company_name.min' => 'Razão social deve conter no mínimo 6 caracteres',
                'company_name.max' => 'Razão social deve conter no máximo 255 caracteres',
                'address.required' => 'Endereço é obrigatório',
                'address.min' => 'Endereço deve conter no mínimo 6 caracteres',
                'address.max' => 'Endereço deve conter no máximo 255 caracteres',
                'contacts.required' => 'Pelo menos um contatos é obrigatório',
            ]
        );

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
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para acessar fornecedores');

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

    public function delete(string $hashedId)
    {

        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para excluir fornecedores');

        $supplier = Supplier::find($this->decodeHash($hashedId));

        if(!$supplier || $supplier->budgets->count() > 0)
            return redirect()->route('suppliers.index')->with('error', 'Este fornecedor está em um pedido de compra e não pode ser excluido');
        else
            $supplierReturn = $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Forncedor: '. $supplier->fantasy_name . ' excluído com sucesso');
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
