var bodyMain = document.querySelector('body');
var shadowMain = document.querySelector('.shadow-main');
var addressMain = document.querySelector('.address-main');
var addressButton = document.querySelector('.address-button');
var closeButton = document.querySelector('.close-button');

// var userLocation = document.querySelector('.user-location');
// var addressInput = document.querySelector('.address-input');
// var customerLocation = document.querySelector('#customer-location');
// var customerLatlng = document.querySelector('#customer-latlng');

function editAddress() {
    const userLocation = document.querySelector('.user-location');
    const addressInput = document.querySelector('.address-input');
    
    bodyMain.style.overflow = 'hidden';
    shadowMain.style.display = 'block';
    addressMain.style.transform = 'translateY(0)';

    addressInput.innerText = userLocation.innerText;
    addressButton.removeAttribute('disabled');
    addressButton.style.background = '#009688';
    addressButton.style.color = '#fefefe';
    addressButton.value = 'Save';
}

function closeAddress() {
    bodyMain.style.overflow = '';
    shadowMain.style.display = 'none';
    addressMain.style.transform = 'translateY(120%)';
}

function openMap() {
    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function (event) {
        history.pushState(null, document.title, location.href);
    });

    const mapContainer = document.querySelector(".map-container");
    const defaultMap = document.querySelector("#map");
    const addressInput = document.querySelector('.address-input');
    const customerLocation = document.querySelector('#customer-location');
    const customerLatlng = document.querySelector('#customer-latlng');

    mapContainer.classList.add('active');
    defaultMap.classList.add('active');

    const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 19,
    center: {
        lat: 40.731,
        lng: -73.997
    }
    });
    const geocoder = new google.maps.Geocoder();
    const infowindow = new google.maps.InfoWindow();
    geocodeLatLng(geocoder, map, infowindow, mapContainer, defaultMap, addressInput, customerLocation, customerLatlng);
}

function geocodeLatLng(geocoder, map, infowindow, mapContainer, defaultMap, addressInput, customerLocation, customerLatlng) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            if (customerLatlng.value == '') {
                var latlng = {
                    lat: parseFloat(position.coords.latitude),
                    lng: parseFloat(position.coords.longitude)
                };
            } else {
                // var newLatlng = customerLatlng.value.split(',');
                var latlng = {
                    lat: parseFloat(position.coords.latitude),
                    lng: parseFloat(position.coords.longitude)
                };
            }
            geocoder.geocode(
            {
                location: latlng
            },
            (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        map.setZoom(19);
                        
                        const marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: true,
                            animation: google.maps.Animation.DROP
                        });
                        
                        google.maps.event.addListener(marker, 'dragend', function() {
                            geocodePosition(marker.getPosition());  
                        });

                        const saveAddressButton = document.querySelector('#save-address-button');
                        saveAddressButton.addEventListener("click", function() {
                            saveGeocodePosition(marker.getPosition());

                            mapContainer.classList.remove('active');
                            defaultMap.classList.remove('active');
                        });

                        const closeAddressButton = document.querySelector('#close-address-button');
                        closeAddressButton.addEventListener("click", function() {
                            mapContainer.classList.remove('active');
                            defaultMap.classList.remove('active');
                        });
                                            
                        function geocodePosition(pos) {
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode(
                                {
                                    latLng: pos
                                },
                                function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {                                        
                                        infowindow.setContent(results[0].formatted_address);
                                    }
                                }
                            );
                        }

                        function saveGeocodePosition(pos) {
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode(
                                {
                                    latLng: pos
                                },
                                function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        infowindow.setContent(results[0].formatted_address);
                                        addressInput.innerText = results[0].formatted_address;
                                        customerLocation.value = results[0].formatted_address;
                                        customerLatlng.value = pos.lat()+','+pos.lng();
                                    }
                                }
                            );
                        }

                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        map.setCenter(latlng);
                    } else {
                        window.alert("No results found");
                    }
                } else {
                    window.alert("Geocoder failed due to: " + status);
                }
            });
        });
    }
}

function saveAddress(userId) {
    const userLocation = document.querySelector('.user-location');
    const addressInput = document.querySelector('.address-input');
    const customerLocation = document.querySelector('#customer-location');
    const customerLatlng = document.querySelector('#customer-latlng');

    addressButton.style.background = '#dddddd';
    addressButton.style.color = '#999999';
    addressButton.value = 'Please Wait';
    addressButton.setAttribute('disabled', 'disabled');

    closeButton.removeAttribute('onclick');
    closeButton.style.color = '#999999';

    var http = new XMLHttpRequest();
    var url = '../requests/save-address.php';
    var params = 'userid='+userId+'&customerlocation='+customerLocation.value+'&customerlatlng='+customerLatlng.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() {
                addressButton.value = 'Saved';
                addressButton.removeAttribute('disabled');
                addressButton.style.background = '#009688';
                addressButton.style.color = '#fefefe';

                closeButton.setAttribute('onclick', 'closeAddress()');
                closeButton.style.color = '#000000';

                addressInput.innerText = http.responseText;
                userLocation.innerText = http.responseText;

                setTimeout(function() {
                    bodyMain.style.overflow = '';
                    shadowMain.style.display = 'none';
                    addressMain.style.transform = 'translateY(120%)';
                }, 1000);
            }, 1000);
        }
    }
    http.send(params);
}

function openProduct(productId) {
    let productCard = document.querySelector('.product-card');

    // productCard.style.animation = 'scale 0.25s ease forwards';
    setTimeout(function() {
        window.location.href = '../views/product.php?productId='+productId;
    }, 350);
}

function openSearchPage() {
    var searchBar = document.querySelector('.search-bar');
    var searchText = document.querySelector('.search-bar .text');
    searchText.innerHTML = 'Opening';
    searchBar.style.background = '#fafafa';
    setTimeout(function() {
        window.location.href = '../views/search.php';
    }, 1000);
}