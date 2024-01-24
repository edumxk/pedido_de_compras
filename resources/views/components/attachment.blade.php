@props(['purchase_order']) @props(['type'])
<div >
    @if($type == 'order')
        @foreach($purchase_order->attachments->whereNull('interaction_id')->whereNull('budget_id') as $attachment)
            <div class="flex inline-flex m-2 text-center just">
                <div class="text-center">
                        <a class="" href="{{ asset('storage/' . $attachment['file_path']) }}" target="_blank">
                            @if($attachment->file_type == 'application/pdf')
                                <x-far-file-pdf width="60px" height="60px" />
                            @elseif($attachment->file_type == 'image/jpeg')
                                <x-far-image width="60px" height="60px" />
                            @elseif($attachment->file_extension == 'docx' || $attachment->file_extension == 'doc')
                                <x-far-file-word width="60px" height="60px" />
                            @elseif($attachment->file_extension == 'xlsx' || $attachment->file_extension == 'xls')
                                <x-far-file-excel width="60px" height="60px" />
                            @elseif($attachment->file_extension == 'txt')
                                <x-grommet-document-txt width="60px" height="60px" />
                            @endif
                        </a>
                    <span>{{ date_format($attachment->created_at, 'd/m/Y H:i:s') }}</span>
                    </div>
            </div>
        @endforeach
    @endif
    @if($type == 'interaction')
        @foreach($purchase_order->attachments->whereNotNull('interaction_id')->whereNull('budget_id') as $attachment)
            <div class="flex inline-flex m-2 text-center just">
                <div class="text-center">
                    <a class="" href="{{ asset('storage/' . $attachment['file_path']) }}" target="_blank">
                        @if($attachment->file_type == 'application/pdf')
                            <x-far-file-pdf width="60px" height="60px" />
                        @elseif($attachment->file_type == 'image/jpeg')
                            <x-far-image width="60px" height="60px" />
                        @elseif($attachment->file_extension == 'docx' || $attachment->file_extension == 'doc')
                            <x-far-file-word width="60px" height="60px" />
                        @elseif($attachment->file_extension == 'xlsx' || $attachment->file_extension == 'xls')
                            <x-far-file-excel width="60px" height="60px" />
                        @elseif($attachment->file_extension == 'txt')
                            <x-grommet-document-txt width="60px" height="60px" />
                        @endif
                    </a>
                    <span>{{ date_format($attachment->created_at, 'd/m/Y H:i:s') }}</span>
                </div>
            </div>
        @endforeach
    @endif
</div>
