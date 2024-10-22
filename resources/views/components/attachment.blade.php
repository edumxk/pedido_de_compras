@props(['purchase_order']) @props(['type']) @props(['interaction']) @props(['budget'])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 bg-white">
    <div class="flex flex-row flex-wrap gap-4 mt-10 justify-start">
        @php
            $attachments = collect();
            if($type == 'order') {
                $attachments = $attachments->concat($purchase_order->attachments->whereNull('interaction_id')->whereNull('budget_id'));
            }
            if($type == 'interaction') {
                $attachments = $attachments->concat($purchase_order->attachments->where('interaction_id', $interaction)->whereNull('budget_id'));
            }
        @endphp

        <div class="flex dark:text-white text-gray-800">
            @foreach($attachments as $attachment)
                <div class="text-center px-4">
                    <a class="flex cursor-pointer justify-center" onclick="openPopup('{{ route('attachments.view', $attachment->file_name) }}')">
                        @if($attachment->file_type == 'application/pdf')
                            <x-far-file-pdf width="30px" height="30px" />
                        @elseif(explode('/', $attachment->file_type)[0] == 'image')
                            <x-far-image width="30px" height="30px" />
                        @elseif($attachment->file_extension == 'docx' || $attachment->file_extension == 'doc')
                            <x-far-file-word width="30px" height="30px" />
                        @elseif($attachment->file_extension == 'xlsx' || $attachment->file_extension == 'xls')
                            <x-far-file-excel width="30px" height="30px" />
                        @elseif($attachment->file_extension == 'txt')
                            <x-grommet-document-txt width="30px" height="30px" />
                        @elseif(explode('/', $attachment->file_type)[0] == 'audio' || explode('/', $attachment->file_type)[0] == 'video')
                            <x-fas-play width="30px" height="30px" />
                        @else
                            <x-grommet-form-attachment width="30px" height="30px" />
                        @endif
                    </a>
                    @if($attachment->name_uploaded)
                        <span class="text-sm dark:text-gray-300 text-gray-600">{{ \Illuminate\Support\Str::limit($attachment->name_uploaded, 20) }}</span>
                    @endif
                    <span class="text-sm dark:text-gray-300 text-gray-600">{{ date_format($attachment->created_at, 'd/m/y H:i:s') }}</span>
                    @if(($attachment->created_at->addHours(6) >= now() && Auth()->user()->id == $attachment->user_id) || Auth()->user()->is_admin)
                        <form action="{{ route('attachments.destroy', $attachment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja EXCLUIR permanentemente este anexo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                <x-fas-trash width="15px" height="15px" />
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function openPopup(src) {
        window.open(src, 'Popup', 'height=600,width=1200');
    }
</script>
