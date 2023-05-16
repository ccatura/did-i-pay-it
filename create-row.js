var payeeNameSelect = document.getElementById('payee-name-select');
var payeeNameInput = document.getElementById('payee-name-input');


payeeNameInput.addEventListener('click', function() {
    payeeNameSelect.value = '';
});

payeeNameSelect.addEventListener('click', function() {
    payeeNameInput.value = '';
});
