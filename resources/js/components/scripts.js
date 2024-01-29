document.querySelectorAll('[id^="toggleButton"]').forEach(function(button) {
    button.addEventListener('click', function() {
        var id = this.id.replace('toggleButton', '');
        document.getElementById('uploads' + id).classList.toggle('hidden');
    });
});

$(document).ready(function() {
    // Get the filter values from LocalStorage
    var subject_description = localStorage.getItem('subject_description');
    var department_id = localStorage.getItem('department_id');
    var user_name = localStorage.getItem('user_name');

    // Set the filter fields to the values from LocalStorage
    $('input[name="subject_description"]').val(subject_description);
    $('select[name="department_id"]').val(department_id);
    $('input[name="user_name"]').val(user_name);

    // Rest of your code...
});

function updateFilters() {
    var subject_description = $('input[name="subject_description"]').val();
    var department_id = $('select[name="department_id"]').val();
    var user_name = $('input[name="user_name"]').val();

    // Store the filter values in LocalStorage
    localStorage.setItem('subject_description', subject_description);
    localStorage.setItem('department_id', department_id);
    localStorage.setItem('user_name', user_name);

    $.ajax({
        url: '/purchase_orders/filter',
        method: 'GET',
        data: {
            subject_description: subject_description,
            department_id: department_id,
            user_name: user_name
        },
        success: function(data) {
            // Update the filters with the new data
            // This will depend on the structure of the data returned from the server
        }
    });
}
