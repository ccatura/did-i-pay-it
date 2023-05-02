var months = document.querySelectorAll('.month');
var checkOffContainer = document.querySelector('.checkoff-container');
var checkAll = document.getElementById('check-all');
var allChecks = document.querySelectorAll('.check input');


checkSize();

window.addEventListener('resize', function() {
    checkSize();
})

checkAll.addEventListener('click', function() {
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
    // console.log(event.target.getAttribute('name'));
    toggleCheckAllButton();
})






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
