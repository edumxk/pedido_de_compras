
<div id="contacts" class="space-y-4 p-6">
    @foreach($supplier->contacts as $contact)
        <div class="flex flex-col space-y-2">
            <label for="contacts" class="text-gray-700 dark:text-gray-200">Contato {{ $loop->index+1 }}</label>
            <input type="text" id="contacts[{{ $loop->index }}][id]" name="contacts[{{ $loop->index }}][id]" value="{{ old('contacts['.$loop->index.'][id]', $contact->id) }}" hidden>
            <input type="text" id="contacts[{{ $loop->index }}][name]" name="contacts[{{ $loop->index }}][name]" value="{{ old('contacts['.$loop->index.'][name]', $contact->name) }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
            <input type="email" id="contacts[{{ $loop->index }}][email]" name="contacts[{{ $loop->index }}][email]" value="{{ old('contacts['.$loop->index.'][email]', $contact->email) }}" class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
            <input type="tel" id="contacts[{{ $loop->index }}][call]" name="contacts[{{ $loop->index }}][call]" value="{{ old('contacts['.$loop->index.'][call]', $contact->call) }}" class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
            <input type="tel" id="contacts[{{ $loop->index }}][call]" name="contacts[{{ $loop->index }}][whatsapp]" value="{{ old('contacts['.$loop->index.'][whatsapp]', $contact->whatsapp) }}" class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
        </div>
    @endforeach
</div>
