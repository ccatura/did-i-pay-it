var months              = document.querySelectorAll('.month');
var checkOffContainer   = document.querySelector('.checkoff-container');
var checkAll            = document.getElementById('check-all');
var allChecks           = document.querySelectorAll('.check input');
var autosave            = document.getElementById('autosave');
var checkAllCols        = document.getElementsByClassName('checkxb');
var rowCount            = document.getElementsByClassName('row').length;
var x;

// Get query string
const queryParams = new URLSearchParams(window.location.search);
var user = queryParams.get('user');
var board = queryParams.get('board');



checkWindowSize();

if (rowCount < 2) {
    document.getElementsByClassName('rowx')[0].remove();
}

window.addEventListener('resize', function() {
    checkWindowSize();
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
    toggleCheckAllButton();
})

for (n=0; n < checkAllCols.length; n++) {
    checkAllCols[n].addEventListener('click', function() {
        countdown();
        toggleMonthCol(this.id);
    })
}



















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
                                data.push({board_id:board, row_id:rows[a].getAttribute('row-id'), payee_id:payees[b].getAttribute('payee-id'), checkbox_id:checkboxes[c].checked});
                            }
                        }
                    }
                }
            }

            // console.log(data);

            // AJAX CALL
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/database-commit.php");
            xhr.onload = function () {
                console.log(this.response);
            };
            xhr.send(JSON.stringify(data));
            clearInterval(x);
        }
    }, 1000);
}

function toggleMonthCol(monthID) {
    var monthCol = document.querySelectorAll("[checkbox-id=" + monthID.split('-')[0] + "]");
    if (!peekAtMonthBoxes(monthCol)) {
        monthCol.forEach( e => {
            e.checked = true;
        })
    } else {
        monthCol.forEach( e => {
            e.checked = false;
        })
    }
}

function toggleCheckAllButton() {
    if (peekAtAllBoxes()) {
        checkAll.innerText = 'Uncheck All';
        return true;
    } else {
        checkAll.innerText = 'Check All';
        return false;
    }
}

function peekAtMonthBoxes(month) {
    var allAreChecked = true;
    month.forEach( function(val) {
        if (val.checked && allAreChecked == true) {
        } else {
            allAreChecked = false;
        }
    })
    return allAreChecked;
}

function peekAtAllBoxes() {
    var allAreChecked = true;
    allChecks.forEach( function(val) {
        if (val.checked && allAreChecked == true) {
        } else {
            allAreChecked = false;
        }
    })
    return allAreChecked;
}

function checkWindowSize() {
    if (this.window.innerWidth < 1050) {
        showOrShortenMonth('single');
            } else {
        showOrShortenMonth('full');
    }
}

function showOrShortenMonth(whichOne) {
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
