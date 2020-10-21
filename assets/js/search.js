function pageBack() {
    window.history.back();
}

window.onload = function() {
    var input = document.querySelector('[name="search-input"]').focus();

    var tagMain = document.querySelectorAll('.tag-main span');
    for (var i = 0; i < tagMain.length; i++) {
        tagMain[i].setAttribute('onclick', 'selectTag()');
    }
}

function selectTag() {
    var targetTag = event.currentTarget;
    var tagMain = document.querySelectorAll('.tag-main span');
    for (var i = 0; i < tagMain.length; i++) {
        tagMain[i].removeAttribute('class');
    }
    targetTag.setAttribute('class', 'active-link');
}

function search() {
    var searchText = document.querySelector('[name="search-input"]');
    var searchButton = document.querySelector('.search-button');
    // var searchTag = document.querySelector('.active-link');

    var categoryMain = document.querySelector('.category-main');
    categoryMain.innerHTML = '';

    if (searchText.value.length > 2) {
        searchButton.value = 'Searching...';
        searchButton.setAttribute('disabled', 'disabled');
        
        var http = new XMLHttpRequest();
        var url = '../requests/search.php';
        var params = 'searchText='+searchText.value;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                setTimeout(() => {
                    console.log(http.responseText);
                    if (http.responseText != 'Nothing found.') {
                        var responses = http.responseText.split('__%%__');
                        for (var i = 0; i < responses.length; i++) {
                            if (responses[i] != '') {
                                var restaunrantId = responses[i].split('__%__')[0];
                                var foodName = responses[i].split('__%__')[1];

                                var searchPlace = document.createElement('span');
                                searchPlace.setAttribute('class', 'search-place');
                                searchPlace.setAttribute('onclick', 'openProduct("'+restaunrantId+'")');
                                searchPlace.innerHTML = foodName;
                                categoryMain.appendChild(searchPlace);
                            }
                        }
                    } else {
                        var searchPlace = document.createElement('span');
                        searchPlace.setAttribute('class', 'search-place');
                        searchPlace.innerHTML = http.responseText;
                        categoryMain.appendChild(searchPlace);
                    }
                                        
                    searchButton.value = 'Search';
                    searchButton.removeAttribute('disabled');
                }, 1500);
            }
        }
        http.send(params);
    } else {
        searchButton.value = 'Too Short';
        searchButton.setAttribute('disabled', 'disabled');
        setTimeout(() => {
            searchButton.value = 'Search';
            searchButton.removeAttribute('disabled');
        }, 1500);
    }
}

function openProduct(productId) {
    window.location.href = '../views/product.php?productId='+productId;
}