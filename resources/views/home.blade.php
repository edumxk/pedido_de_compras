<x-app-layout>
    <x-input-error/>
    <x-error/>
    <div class="flex flex-col items-center justify-center min-h-screen dark:bg-gray-800 dark:text-gray-200 bg-gray-100 py-2">
        <div class="text-center">
            <h1 class="text-4xl font-bold dark:text-gray-100 text-gray-900 mb-6">Bem Vindo a intranet</h1>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#26e07f;">
                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                            <g fill="#1fb141">
                                <path d="M21.5,21.5v129h64.5v-32.25v-64.5v-32.25zM86,53.75c0,17.7805 14.4695,32.25 32.25,32.25c17.7805,0 32.25,-14.4695 32.25,-32.25c0,-17.7805 -14.4695,-32.25 -32.25,-32.25c-17.7805,0 -32.25,14.4695 -32.25,32.25zM118.25,86c-17.7805,0 -32.25,14.4695 -32.25,32.25c0,17.7805 14.4695,32.25 32.25,32.25c17.7805,0 32.25,-14.4695 32.25,-32.25c0,-17.7805 -14.4695,-32.25 -32.25,-32.25z"></path>
                            </g>
                        </g>
                    </svg>
                    <a href="{{ route('purchase_orders.index') }}" class="text-2xl font-semibold dark:text-gray-300 text-gray-700 hover:text-kokar ">Ordens de Compras</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
