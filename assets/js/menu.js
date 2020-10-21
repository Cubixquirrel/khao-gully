var splitPath   = window.location.pathname.split('/');
var currentPath = splitPath[splitPath.length - 1];

var menu = document.querySelectorAll('.menu-main .menu');
for (var i = 0; i < menu.length; i++) {
    var menuText = menu[i].querySelector('span').innerText.toLowerCase();
    
    menu[i].setAttribute('data-target', menuText);
    menu[i].setAttribute('data-count', i+1);
    menu[i].setAttribute('onclick', 'menuActive("'+menuText+'")');

    if (menuText + '.php' == currentPath) {
        menu[i].setAttribute('class', 'menu menu-active');
    }
}

function menuActive(dataTarget) {    
    var currentMenu = document.querySelector('[data-target="'+dataTarget+'"]');
    var lastMenu = document.querySelector('.menu-main .menu.menu-active');

    var lastCount = lastMenu.getAttribute('data-count');
    var currentCount = currentMenu.getAttribute('data-count');

    lastMenu.setAttribute('class', 'menu');
    currentMenu.setAttribute('class', 'menu menu-active');

    if (parseInt(currentCount) == parseInt(lastCount)) {
        console.log('current is same');
    }else if (parseInt(currentCount) > parseInt(lastCount)) {
        console.log('current is in right');
    } else {
        console.log('current is in left');
    }

    setTimeout(function() {
        window.location.href = '../views/'+dataTarget+'.php';
    }, 600);
}