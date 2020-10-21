function pageBack() {
    window.history.back();
}

var helpInput  = document.querySelector('.help-input');
var helpButton = document.querySelector('.help-button');

function checkHelpMessage() {
    if (helpInput.value.length >= 20) {
        helpButton.removeAttribute('disabled');
        helpButton.style.background = '#009688';
        helpButton.style.color = '#fefefe';
    } else {
        helpButton.setAttribute('disabled', 'disabled');
        helpButton.style.background = '#dddddd';
        helpButton.style.color = '#888888';
    }
}

function sendHelpMessage(userId) {
    if (helpInput.value.length >= 20) {
        helpButton.style.background = '#dddddd';
        helpButton.style.color = '#999999';
        helpButton.value = 'Please Wait';
        helpButton.setAttribute('disabled', 'disabled');

        var http = new XMLHttpRequest();
        var url = '../requests/send-help.php';
        var params = 'userid='+userId+'&helpMessage='+helpInput.value;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                setTimeout(function() {
                    console.log(http.responseText);
                    helpButton.value = 'Message Submitted';
                    helpButton.style.background = '#009688';
                    helpButton.style.color = '#fefefe';

                    helpInput.value = '';

                    setTimeout(function() {
                        helpButton.value = 'Submit';
                        helpButton.style.background = '#dddddd';
                        helpButton.style.color = '#888888';
                    }, 2000);
                }, 2000);
            }
        }
        http.send(params);
    }
}