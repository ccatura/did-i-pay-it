var payeeNameSelect = document.getElementById('payee-name-select');
var payeeNameInput = document.getElementById('payee-name-input');
var submit = document.getElementById('submit');
var submitMore = document.getElementById('submit-more');
var rowJustAdded = document.getElementById('row-just-added');



payeeNameInput.addEventListener('click', function() {
    payeeNameSelect.selectedIndex = 0;
    disableSubmit();
});

payeeNameSelect.addEventListener('click', function() {
    payeeNameInput.value = '';
    disableSubmit();
});

payeeNameInput.addEventListener('input', function() {
    disableSubmit();
    rowJustAdded.value = payeeNameInput.value;
});

payeeNameSelect.addEventListener('input', function() {
    disableSubmit();
    rowJustAdded.value = payeeNameSelect.options[payeeNameSelect.selectedIndex].text;
});


function disableSubmit() {
    if (payeeNameInput.value == '' && payeeNameSelect.selectedIndex == 0) {
        submit.disabled = true;
        submitMore.disabled = true;
    } else if (payeeNameInput.value != '' || payeeNameSelect != '') {
        submit.disabled = false;
        submitMore.disabled = false;
    }
}