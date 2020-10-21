function pageBack() {
    window.history.back();
}

var feedbackInput  = document.querySelector('.feedback-input');
var feedbackButton = document.querySelector('.feedback-button');

function checkFeedback() {
    if (feedbackInput.value.length >= 20) {
        feedbackButton.removeAttribute('disabled');
        feedbackButton.style.background = '#009688';
        feedbackButton.style.color = '#fefefe';
    } else {
        feedbackButton.setAttribute('disabled', 'disabled');
        feedbackButton.style.background = '#dddddd';
        feedbackButton.style.color = '#888888';
    }
}

function sendFeedback(userId) {
    if (feedbackInput.value.length >= 20) {
        feedbackButton.style.background = '#dddddd';
        feedbackButton.style.color = '#999999';
        feedbackButton.value = 'Please Wait';
        feedbackButton.setAttribute('disabled', 'disabled');

        var http = new XMLHttpRequest();
        var url = '../requests/send-feedback.php';
        var params = 'userid='+userId+'&feedback='+feedbackInput.value;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                setTimeout(function() {
                    console.log(http.responseText);
                    feedbackButton.value = 'Feedback Submitted';
                    feedbackButton.style.background = '#009688';
                    feedbackButton.style.color = '#fefefe';

                    feedbackInput.value = '';

                    setTimeout(function() {
                        feedbackButton.value = 'Submit';
                        feedbackButton.style.background = '#dddddd';
                        feedbackButton.style.color = '#888888';
                    }, 2000);
                }, 2000);
            }
        }
        http.send(params);
    }
}