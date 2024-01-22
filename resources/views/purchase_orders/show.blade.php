<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900">Detalhes da Ordem de Compra</h1>
        </div>


    <div class="flex justify-center pb-5 px-6">
        <div class="inline-block w-48 h-12 text-center ">
            <label class="" for="purchase_subject">{{ __("Assunto") }}</label>
        </div>
        <div class="flex grow justify-items-center h-12">
            <input class="grow rounded border-0 p-0" type="text" id="purchase_subject" name="purchase_subject" value="{{ $purchase_order->purchase_subject }}" disabled>
        </div>
    </div>
    <div class="flex justify-center pb-5 px-6">
        <div class="inline-block w-48 h-12 text-center ">
            <label class="" for="description">{{ __("Descrição") }}</label>
        </div>
        <div class="flex grow justify-items-center h-12">
            <input class="grow rounded border-0 p-0 hover:text-gray-500" type="text" id="description" name="description" value="{{ $purchase_order->description }}" disabled>
        </div>
    </div>

    <div>
         <h1>Upload de Arquivos</h1>
            <form action="{{ route('attachments.upload', $purchase_order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file">
                <button type="submit">Enviar</button>
            </form>
    </div>

        @forelse($purchase_order->attachments as $attachment)
            @if($loop->first)
                <h1>Arquivos Anexados</h1>
            @endif
            @if($attachment->file_extension == 'pdf')
                <div>
                    <span class="text-2xl">PDF</span>
                    <iframe src="{{ asset('storage/' .$attachment['file_path']) }}" width="50%" height="600px"> </iframe>
                </div>
            @endif

            @if($attachment->file_extension == 'jpg' || $attachment->file_extension == 'png' || $attachment->file_extension == 'jpeg')
                <div>
                    <span class="text-2xl">Imagem</span>
                    <img src="{{ asset('storage/' . $attachment['file_path']) }}" alt="image" width="50%" height="600px" />
                </div>
            @endif
            @if($attachment->file_extension == 'docx' || $attachment->file_extension == 'doc')
                <div>
                    <span class="text-2xl">Arquivo de Word</span>
                    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('storage/' . $attachment['file_path']) }}" width="50%" height="600px"> </iframe>
                </div>
            @endif
            @if($attachment->file_extension == 'xlsx' || $attachment->file_extension == 'xls')
                <div>
                    <span class="text-2xl">Arquivo de Excel</span>
                    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('storage/' . $attachment['file_path']) }}" width="50%" height="600px"> </iframe>
                </div>
            @endif
            @if($attachment->file_extension == 'txt')
                <div>
                    <span class="text-2xl">Arquivo de texto</span>
                    <iframe src="{{ asset('storage/' . $attachment['file_path']) }}" width="50%" height="600px"> </iframe>
                </div>
            @endif
        @empty
            <div>
                <p>Nenhum arquivo anexado</p>
            </div>
        @endforelse
        <a class="w-20 bg-red-500 ml-2 p-2 rounded bg-gray-500" href="{{ route('purchase_orders.index') }}"> Retornar</a>


</div>


</x-app-layout>
