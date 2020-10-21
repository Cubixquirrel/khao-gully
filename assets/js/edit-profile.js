function pageBack() {
    window.history.back();
}

var mobileNumber = document.querySelector('#mobile-number');
var customerName = document.querySelector('#customer-name');
var customerEmail = document.querySelector('#customer-email');
var customerLocation = document.querySelector('#customer-location');
var saveButton = document.querySelector('#save-button');

var birthDate = document.querySelector('#birth-date');
var birthMonth = document.querySelector('#birth-month');
var birthYear = document.querySelector('#birth-year');

function enableButton(number) {
    if (number == '1') {
        if ((customerName.value.length >= 1) && (customerLocation.value.length >= 1)) {
            saveButton.removeAttribute('disabled');
            saveButton.style.background = '#009688';
            saveButton.style.color = '#fefefe';
        } else if ((customerName.value.length >= 1) && (customerEmail.value.length >= 1) && (customerLocation.value.length >= 1)) {
            saveButton.removeAttribute('disabled');
            saveButton.style.background = '#009688';
            saveButton.style.color = '#fefefe';
        } else {
            saveButton.setAttribute('disabled', 'disabled');
            saveButton.style.background = '#dddddd';
            saveButton.style.color = '#999999';
        }
    }
}

function enableSaveChanges() {
    saveButton.removeAttribute('disabled');
    saveButton.style.background = '#009688';
    saveButton.style.color = '#fefefe';
}

function saveChanges() {
    saveButton.value = 'Please Wait';
    saveButton.setAttribute('disabled', 'disabled');
    saveButton.style.background = '#dddddd';
    saveButton.style.color = '#999999';
    
    var http = new XMLHttpRequest();
    var url = '../requests/save-changes.php';
    var params = 'birthDate='+birthDate.value+'&birthMonth='+birthMonth.value+'&birthYear='+birthYear.value+'&customername='+customerName.value+'&customeremail='+customerEmail.value+'&customerlocation='+customerLocation.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() {
                var splits = http.responseText.split('__%__');

                if (splits[3] == 'found') {
                    saveButton.value = 'Saved';
                    saveButton.style.background = '#009688';
                    saveButton.style.color = '#fefefe';
                
                    customerName.value = splits[0];
                    customerEmail.value = splits[1];
                    customerLocation.value = splits[2];                

                    setTimeout(function() {                        
                        //saveButton.value = 'Save Changes';
                        //saveButton.style.background = '#dddddd';
                        //saveButton.style.color = '#999999';
                        
                        window.history.back();
                    }, 600);
                }
            }, 2000);
        }
    }
    http.send(params);
}