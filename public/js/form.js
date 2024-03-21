document.getElementById('addContact').addEventListener('click', function() {
    let contactsDiv = document.getElementById('contacts');
    contactsDiv.className = 'flex flex-col space-y-2 mt-4 p-6';
    let index = contactsDiv.children.length;


    //include a label for contact container with index
    let label = document.createElement('label');
    label.textContent = 'Novo Contato ';
    label.className = 'text-gray-700 dark:text-gray-200';
    contactsDiv.appendChild(label);


    let nameInput = createInput('text', 'contacts[' + index + '][name]', 'Nome do Contato', true);
    contactsDiv.appendChild(nameInput);

    let emailInput = createInput('email', 'contacts[' + index + '][email]', 'Email do Contato');
    contactsDiv.appendChild(emailInput);

    let phoneInput = createInput('text', 'contacts[' + index + '][call]', 'Telefone do Contato');
    contactsDiv.appendChild(phoneInput);

    let whatsApp = createInput('text', 'contacts[' + index + '][whatsapp]', 'WhatsApp do Contato', true);
    contactsDiv.appendChild(whatsApp);

    let deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.textContent = 'Remover';
    deleteButton.className = 'px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600';
    deleteButton.addEventListener('click', function() {
        contactsDiv.removeChild(label);
        contactsDiv.removeChild(nameInput);
        contactsDiv.removeChild(emailInput);
        contactsDiv.removeChild(phoneInput);
        contactsDiv.removeChild(whatsApp);
        contactsDiv.removeChild(deleteButton);
    });
    contactsDiv.appendChild(deleteButton);
});

function createInput(type, name, placeholder, required = false) {
    let input = document.createElement('input');
    input.type = type;
    input.name = name;
    input.placeholder = placeholder;
    input.className = 'px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200 p-6';
    if (required) {
        input.required = true;
    }
    return input;
}


//on documents load, add delete button to existing contacts
document.addEventListener('DOMContentLoaded', function() {
    let contactsDiv = document.getElementById('contacts');
    let contacts = contactsDiv.children;
    for (let i = 0; i < contacts.length; i++) {
        let deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Remover';
        deleteButton.className = 'px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600';
        deleteButton.addEventListener('click', function() {
            contactsDiv.removeChild(contacts[i]);
        });
        contacts[i].appendChild(deleteButton);
    }
});

document.getElementById('cnpj').addEventListener('change', function() {
    var cnpj = this.value.replace(/[^0-9]/g, '');

    fetch('/suppliers/getAll/' + cnpj)
        .then(response => response.json())
        .then(data => {
            document.getElementById('fantasy_name').value = data.razao_social;
            document.getElementById('company_name').value = data.nome_fantasia;
            document.getElementById('address').value = data.endereco;

        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocorreu um erro ao buscar os dados do fornecedor. Por favor, tente novamente.');

            // Limpar os campos
            document.getElementById('fantasy_name').value = '';
            document.getElementById('company_name').value = '';
            document.getElementById('address').value = '';

        });
});

console.log('form.js loaded!')
