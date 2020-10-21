var splitPath   = window.location.pathname.split('/');
var currentPath = splitPath[splitPath.length - 1];

var menu = document.querySelectorAll('.profile-menu-list');
for (var i = 0; i < menu.length; i++) {
    var menuText = menu[i].querySelector('span').innerText.toLowerCase().split(' ').join('-');
    
    menu[i].setAttribute('data-target', menuText);
    menu[i].setAttribute('data-count', i+1);
    menu[i].setAttribute('onclick', 'menuActive("'+menuText+'")');
}

function openEditProfile() {
    window.location.href = '../views/edit-profile.php';
}

function menuActive(dataTarget) {
    if (dataTarget == 'log-out') {
        logout();
    } else {
        window.location.href = '../views/'+dataTarget+'.php';
    }
}

function logout() {
    var http = new XMLHttpRequest();
    var url = '../requests/logout.php';
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            window.location.href = '../views/get-started.php';
        }
    }
    http.send();
}