var months = document.querySelectorAll('.month');
var checkOffContainer = document.querySelector('.checkoff-container');
var checkAll = document.getElementById('check-all');
var allChecks = document.querySelectorAll('.check input');
var autosave = document.getElementById('autosave');
var x;

checkSize();

window.addEventListener('resize', function() {
    checkSize();
})

checkAll.addEventListener('click', function() {
    countdown();
    if (!toggleCheckAllButton()) {
        allChecks.forEach( e => {
            e.checked = true;
        })
    } else {
        allChecks.forEach( e => {
            e.checked = false;
        })
    }
    toggleCheckAllButton();
})

checkOffContainer.addEventListener('input', function() {
    countdown();
    // console.log(event.target.getAttribute('board_row_info'));
    toggleCheckAllButton();
})












function countdown() {
    var autosaveInterval = 6; //default should be 6
    clearInterval(x);
    x = setInterval(function() {
        if(autosaveInterval > 1) {
            autosaveInterval -= 1;
            autosave.innerText = " in... " + autosaveInterval;
        } else {
            autosave.innerText = "d!";
            var data = [];

            // Gather all info to send to DB
            var rows        = document.getElementsByClassName('row');
            var payees      = document.getElementsByClassName('payee');
            var checkboxes  = document.getElementsByClassName('checkbox');

            for (var a = 0; a < rows.length; a++) { // Each row (record)
                for (var b = 0; b < payees.length; b++) { // Each payee in above row
                    if (rows[a].getAttribute('row-id') == payees[b].getAttribute('row-id')) {
                        for (var c = 0; c < checkboxes.length; c++) { // All checkboxes for above payee
                            if (payees[b].getAttribute('row-id') == checkboxes[c].getAttribute('row-id')) { // Each checkbox individually
                                data.push({row_id:rows[a].getAttribute('row-id'), payee_id:payees[b].getAttribute('payee-id'), checkbox_id:checkboxes[c].checked});
                            }
                        }
                    }
                }
            }

            // AJAX CALL
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/database-write.php");
            xhr.onload = function () {
                console.log(this.response);
            };
            xhr.send(JSON.stringify(data));
            clearInterval(x);
        }
    }, 1000);
}

function toggleCheckAllButton() {
    if (peekAtCheckBoxes()) {
        checkAll.innerText = 'Uncheck All';
        return true;
    } else {
        checkAll.innerText = 'Check All';
        return false;
    }
}

function peekAtCheckBoxes() {
    var allAreChecked = true;
    allChecks.forEach( function(val, i) {
        if (val.checked && allAreChecked == true) {
        } else {
            allAreChecked = false;
        }
    })
    return allAreChecked;
}

function checkSize() {
    if (this.window.innerWidth < 1050) {
        showMonth('single');
            } else {
        showMonth('full');
    }
}

function showMonth(whichOne) {
    if (whichOne == 'single') {
        months.forEach(e => {
            e.innerText = e.getAttribute('month').charAt(0);
        })
    } else if (whichOne == 'full') {
        months.forEach(e => {
            e.innerText = e.getAttribute('month');
        })
    }
}
