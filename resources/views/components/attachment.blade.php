@props(['purchase_order']) @props(['type']) @props(['interaction']) @props(['budget'])
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-6 mt-10">
        @php
            $attachments = collect();
            if($type == 'order') {
                $attachments = $attachments->concat($purchase_order->attachments->whereNull('interaction_id')->whereNull('budget_id'));
            }
            if($type == 'interaction') {
                $attachments = $attachments->concat($purchase_order->attachments->where('interaction_id', $interaction)->whereNull('budget_id'));
            }
        @endphp

        @foreach($attachments as $attachment)
            <div class="flex-1 text-center">
                <a class="flex justify-center cursor-pointer" onclick="openPopup('{{ asset('storage/' . $attachment['file_path']) }}')">
                    @if($attachment->file_type == 'application/pdf')
                        <x-far-file-pdf width="30px" height="30px" />
                    @elseif(explode('/',$attachment->file_type)[0] == 'image')
                        <x-far-image width="30px" height="30px" />
                    @elseif($attachment->file_extension == 'docx' || $attachment->file_extension == 'doc')
                        <x-far-file-word width="30px" height="30px" />
                    @elseif($attachment->file_extension == 'xlsx' || $attachment->file_extension == 'xls')
                        <x-far-file-excel width="30px" height="30px" />
                    @elseif($attachment->file_extension == 'txt')
                        <x-grommet-document-txt width="30px" height="30px" />
                    @elseif(explode('/',$attachment->file_type)[0] == 'audio' || explode('/',$attachment->file_type)[0] == 'video')
                        <x-fas-play width="30px" height="30px" />
                    @else
                        <x-grommet-form-attachment width="30px" height="30px" />
                    @endif
                </a>
                <span class="text-sm">{{ date_format($attachment->created_at, 'd/m/y H:i:s') }}</span>
            </div>
        @endforeach
    </div>
</div>

<script>
    function openPopup(src) {
        window.open(src, 'Popup', 'height=600,width=1200');
    }
</script>