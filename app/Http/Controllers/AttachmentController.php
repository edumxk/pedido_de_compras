<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
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

        Attachment::create($data);

        return redirect()->back()->with('message', 'Attachment uploaded successfully');

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
    public function view(string|int $file_name)
    {
        $attachment = Attachment::findOrFail($file_name);
        if (isset($attachment->file_path)) {
            return response()->file(storage_path('app/public/' . $attachment->file_path));
        }else
            return redirect()->back()->with('error', 'File not found');
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
