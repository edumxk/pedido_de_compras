
@if($errors->any())
    <div class="bg-red-50 dark:bg-red-600 rounded p-4 ">
        <ul class="list-disc pl-5 text-red-600 dark:text-red-300">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
