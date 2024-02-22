<div class="flex justify-between dark:text-gray-200 dark:hover:">
    <div>
        <a href="{{ route('budgets.products', $budget->hashedId) }}">
            <p class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">{{ $budget->supplier->fantasy_name }}
             {{ $budget->created_at->format('d/m/Y h:m:s') }}</p>
            <p class="text-xs sm:text-sm md:text-base lg:text-lg">{{ $budget->supplier->cnpj }}</p>
            <p class="text-xs sm:text-sm md:text-base lg:text-lg">{{ $budget->user->name }}</p>
        </a>
    </div>
</div>
