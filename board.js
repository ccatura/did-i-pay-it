var months              = document.querySelectorAll('.month');
var checkOffContainer   = document.querySelector('.checkoff-container');
var checkAll            = document.getElementById('check-all');
var allChecks           = document.querySelectorAll('.check input');
var autosave            = document.getElementById('autosave');
var headerInner         = document.getElementById('header-inner');
var checkAllCols        = document.getElementsByClassName('checkxb');
var deleteRow           = document.getElementsByClassName('delete-row');
var rowCount            = document.getElementsByClassName('row').length;
var x;

// Get query string
const queryParams = new URLSearchParams(window.location.search);
var user = queryParams.get('user');
var board = queryParams.get('board');



checkWindowSize();
turnArrowGreen();

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
    turnArrowGreen();
})

checkOffContainer.addEventListener('input', function() {
    countdown();
    toggleCheckAllButton();
    turnArrowGreen();
})

for (n=0; n < checkAllCols.length; n++) {
    checkAllCols[n].addEventListener('click', function() {
        countdown();
        toggleMonthCol(this.id.split('-')[0]);
        turnArrowGreen();
    })
}

for (m=0; m < deleteRow.length; m++) {
    deleteRow[m].addEventListener('click', function(e) {
        console.log(e.target.getAttribute('row-id'));
    })
}









/* Call this to check all arrows. Turns completed months to green. */
function turnArrowGreen() {
    for (y=0; y < checkAllCols.length; y++) {
        if (peekAtMonthBoxes(getMonthCol(checkAllCols[y].id))) {
            checkAllCols[y].classList.add('complete');
        } else {
            checkAllCols[y].classList.remove('complete');
        }
    }
}

/* Pass any month name to get that column's accumulative state. If all are checked, returns true, otherwise false. */
function getMonthCol(monthID) {
    return document.querySelectorAll("[checkbox-id=" + monthID.split('-')[0] + "]");
}

/* Pass any month name to toggle the 'check all' arrow to green if all month's checkboxes are cheked, otherwise tuens arrow to neutral */
function toggleMonthCol(monthID) {
    monthCol = getMonthCol (monthID);
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

/* If all checkboxes are cheked, turns them off. Otherwise turns the remaining boxes on. */
function toggleCheckAllButton() {
    if (peekAtAllBoxes()) {
        checkAll.innerText = 'Uncheck All';
        return true;
    } else {
        checkAll.innerText = 'Check All';
        return false;
    }
}

/* Pass an array of elements (checkboxes). If they are all checked, returns true, otherwise returns false. */
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

/* Returns true if all boxes are checked, otherwise returns false. */
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

/* If window is too small, labels months with only first letter. Otherwise shows entire month name */
function checkWindowSize() {
    if (this.window.innerWidth < 1050) {
        showOrShortenMonth('single');
            } else {
        showOrShortenMonth('full');
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
}

/* Resets and starts the countdown for autosave */
function countdown() {
    header.style.opacity = 1;
    var autosaveInterval = 4; // Seconds +1
    clearInterval(x);
    x = setInterval(function() {
        if(autosaveInterval > 1) {
            autosaveInterval -= 1;
            autosave.innerHTML = "&nbsp;in... " + autosaveInterval;
        } else {
            autosave.innerHTML = "d!";
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

            // AJAX CALL - Sends data to be autosaved
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./database-commit.php");
            xhr.onload = function () {
                console.log(this.response);
            };
            xhr.send(JSON.stringify(data));
            clearInterval(x);
            var fadeIn = setTimeout(() => {
                header.style.opacity = 0;
                var resetHeader = setTimeout(() => {
                    // clearTimeout(fadeIn);
                    headerInner.innerText = 'AutoSave';
                    autosave.innerHTML = '&nbsp;Enabled';
                    // clearTimeout(resetHeader);
                }, 1000);
            }, 2000);
        }
    }, 1000);
}
