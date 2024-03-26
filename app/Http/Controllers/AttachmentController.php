<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Purchase_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {


        $file = $request->file('file');
        $file_name = md5($file->getClientOriginalName().now()) . '.' . $file->getClientOriginalExtension();
        $file_path = $file->storeAs('attachments', $file_name, 'public');
        $file_type = $file->getClientMimeType();
        $file_size = $file->getSize();
        $data = [
            'file_name' => $file_name,
            'file_path' => $file_path,
            'file_type' => $file_type,
            'file_size' => $file_size,
            'file_extension' => $file->getClientOriginalExtension(),
            'purchase_order_id' => $request->purchase_order_id,
            'budget_id' => $request->budget_id,
            'interaction_id' => $request->interaction_id
        ];

        try{
            Attachment::create($data);
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Erro ao anexar o arquivo, procure o TI');
        }
        \Log::info('Arquivo enviado com sucesso');
        /*
        try {
            $purchase_order = Purchase_order::find($request->purchase_order_id);
            $attachment = $purchase_order->attachments->last();
            $this->sendEmail($purchase_order, null, $attachment); --remove envio de email em anexos
        }catch (\Exception $e){
            \Log::info('error send email: '. $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao enviar email de anexo.');
        }*/

        return redirect()->back()->with('success', 'Arquivo enviado com sucesso!');

    }

    public function download(string|int $id)
    {
        $attachment = Attachment::findOrFail($id);
        if (isset($attachment->file_path)) {
            return response()->download(storage_path('app/public/' . $attachment->file_path));
        }else
            return redirect()->back()->with('error', 'File not found');
    }

    //return view of the file
    public function view(string $file_name)
    {
        $attachment = Attachment::where('file_name', $file_name)->firstOrFail();
        if (isset($attachment['file_path'])) {
            return response()->file(storage_path('app/public/' . $attachment['file_path']));
        }else
            return redirect()->back()->with('error', 'Arquivo não encontrado no servidor.');
    }

    public function destroy($id)
    {

        //delete the attachment by id
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();

        //delete local file
        Storage::delete('public/' . $attachment->file_path);

        return redirect()->back()->with('success', 'Attachment deleted successfully');

    }
}
