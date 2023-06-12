var fullname            = document.getElementById('name');
var origName            = fullname.value;
var email               = document.getElementById('email');
var origEmail           = email.value;
var pword               = document.getElementById('pword');
var origPword           = pword.value;
var userName            = document.getElementById('user-name');
var userNameDisabled    = document.getElementById('user-name-disabled');
var submit              = document.getElementById('submit');
var sqlName;
var sqlEmail;
var sqlPword;

fullname.addEventListener('change', function() {
    if (fullname.value != origName) {
        sqlName = "UPDATE `payer` SET `name` = '" + fullname.value + "' WHERE `user_name` = '" + userName.value + "';\n";
    } else {
        sqlName = undefined;
    }
    console.log(sqlName);
})

email.addEventListener('change', function() {
    if (email.value != origEmail) {
        sqlEmail = "UPDATE `payer` SET `email` = '" + email.value + "' WHERE `user_name` = '" + userName.value + "';\n";
    } else {
        sqlEmail = undefined;
    }
    console.log(sqlEmail);
})

pword.addEventListener('change', function() {
    if (pword.value != origPword) {
        sqlPword = "UPDATE `payer` SET `pword` = '" + pword.value + "' WHERE `user_name` = '" + userName.value + "';\n";
    } else {
        sqlPword = undefined;
    }
})

userNameDisabled.addEventListener('click', function() {
    alert('You cannot change your user name.');
})


submit.addEventListener('click', function() {
    var sql = [];
    sql.push(sqlName, sqlEmail, sqlPword);
    doAjax(sql);
    sqlName = undefined;
    sqlEmail = undefined;
    sqlPword = undefined;
})



function doAjax(sql) {
    for (var q of sql) {
        if (q != undefined) {
            // AJAX CALL - Sends data to be autosaved
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./edit-account-commit.php?name=" + fullname.value);
            xhr.onload = function () {
                console.log(this.response);
                console.log('Settings updated successfully!');
                // location.reload();
                window.location = "./list-boards.php"
            };

            xhr.send(JSON.stringify(q));
        }
    }
}