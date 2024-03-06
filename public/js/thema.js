// Verifica se o tema do sistema operacional é dark
let isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// Envia uma requisição AJAX para atualizar a sessão.
if(isDarkMode) {
    fetch('/set-dark-mode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            dark_mode: isDarkMode,
        }),
    });
    console.log(`dark_mode: ${isDarkMode}`);
    }
