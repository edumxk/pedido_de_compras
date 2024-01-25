document.querySelectorAll('[id^="toggleButton"]').forEach(function(button) {
    button.addEventListener('click', function() {
        var id = this.id.replace('toggleButton', '');
        document.getElementById('uploads' + id).classList.toggle('hidden');
    });
});
