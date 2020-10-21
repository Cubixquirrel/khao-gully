var mobileNumber = document.querySelector('#mobile-number');
var sendButton = document.querySelector('#send-button');

var closeButton = document.querySelector('#close-button');
var otpBox = document.querySelector('#otp-box');
var displayMobile = document.querySelector('#display-mobile');
var otp = document.querySelector('#otp');
var confirmButton = document.querySelector('#confirm-button');
var resendButton = document.querySelector('#resend-button');

var personalBox = document.querySelector('#personal-box');
var customerName = document.querySelector('#customer-name');
var customerEmail = document.querySelector('#customer-email');

var openMapButton = document.querySelector('.open-map-button');
var customerLocation = document.querySelector('#customer-location');
var customerLatlng = document.querySelector('#customer-latlng');

var finishButton = document.querySelector('#finish-button');

var html = document.querySelector('html');

function openPage(path) {
    window.location.href = '../views/'+path+'.php';
}

function enableButton(number) {
    if (number == '10') {
        if (mobileNumber.value.length == 10) {
            sendButton.removeAttribute('disabled');
            sendButton.style.background = '#009688';
            sendButton.style.color = '#fefefe';
        } else {
            sendButton.setAttribute('disabled', 'disabled');
            sendButton.style.background = '#dddddd';
            sendButton.style.color = '#999999';
        }
    } else if (number == '6') {
        if (otp.value.length == 6) {
            confirmButton.value = 'Confirm';
            confirmButton.removeAttribute('disabled');
            confirmButton.style.background = '#009688';
            confirmButton.style.color = '#fefefe';
                
            closeButton.removeAttribute('disabled');
            closeButton.style.color = '#000000';
        } else {
            confirmButton.value = 'Confirm';
            confirmButton.setAttribute('disabled', 'disabled');
            confirmButton.style.background = '#dddddd';
            confirmButton.style.color = '#999999';
        }
    } else if (number == '1') {
        if ((customerName.value.length >= 1) && (customerLocation.value.length >= 1)) {
            finishButton.removeAttribute('disabled');
            finishButton.style.background = '#009688';
            finishButton.style.color = '#fefefe';
        } else {
            finishButton.setAttribute('disabled', 'disabled');
            finishButton.style.background = '#dddddd';
            finishButton.style.color = '#999999';
        }
    }
}

function enableClickButton() {
    if (otp.value.length == 6) {
        confirmButton.value = 'Confirm';
        confirmButton.removeAttribute('disabled');
        confirmButton.style.background = '#009688';
        confirmButton.style.color = '#fefefe';
            
        closeButton.removeAttribute('disabled');
        closeButton.style.color = '#000000';
    } else {
        confirmButton.value = 'Confirm';
        confirmButton.setAttribute('disabled', 'disabled');
        confirmButton.style.background = '#dddddd';
        confirmButton.style.color = '#999999';
    }
}

function closeOTP() {
    var closeDisabled = closeButton.getAttribute('disabled');
    if (!closeDisabled) {
        displayMobile.innerText = '';
        otp.value = '';
        confirmButton.value = 'Confirm';
        confirmButton.style.background = '#dddddd';
        confirmButton.style.color = '#999999';
        confirmButton.setAttribute('disabled', 'disabled');
        otpBox.style.transform = 'translateY(120%)';
    }
}

function sendOTP() {
    sendButton.setAttribute('disabled', 'disabled');
    sendButton.value = 'Sending';
    displayMobile.innerText = mobileNumber.value;

    var http = new XMLHttpRequest();
    var url = '../requests/send-otp.php';
    var params = 'mobile='+mobileNumber.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() { 
                sendButton.value = 'Send OTP';
                sendButton.removeAttribute('disabled');
                otpBox.style.transform = 'translateY(0)';
            }, 1000);
        }
    }
    http.send(params);
}

function resendOTP() {
    resendButton.setAttribute('disabled', 'disabled');
    resendButton.value = 'Sending OTP';

    otp.value = '';

    confirmButton.value = 'Confirm';
    confirmButton.setAttribute('disabled', 'disabled');
    confirmButton.style.background = '#dddddd';
    confirmButton.style.color = '#999999';

    closeButton.removeAttribute('disabled');
    closeButton.style.color = '#000000';

    var http = new XMLHttpRequest();
    var url = '../requests/send-otp.php';
    var params = 'mobile='+mobileNumber.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() { 
                resendButton.value = 'OTP sent';
            }, 1000);

            setTimeout(function() { 
                resendButton.value = 'Resend now';
                resendButton.removeAttribute('disabled');
            }, 3000);
        }
    }
    http.send(params);
}

function confirmOTP() {
    closeButton.setAttribute('disabled', 'disabled');
    closeButton.style.color = '#dddddd';

    confirmButton.setAttribute('disabled', 'disabled');
    confirmButton.value = 'Verifying';
    confirmButton.style.background = '#dddddd';
    confirmButton.style.color = '#999999';

    var http = new XMLHttpRequest();
    var url = '../requests/confirm-otp.php';
    var params = 'mobile='+mobileNumber.value+'&otp='+otp.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() {
                if (http.responseText == 'true') {
                    confirmButton.value = 'Confirmed';
                    confirmButton.removeAttribute('disabled');
                    confirmButton.style.background = '#009688';
                    confirmButton.style.color = '#fefefe';
                    personalBox.style.transform = 'translateY(0)';
                } else if (http.responseText == 'false') {
                    confirmButton.value = 'Incorrect OTP';
                    confirmButton.style.background = '#F44336';
                    confirmButton.style.color = '#fefefe';
                    
                    closeButton.removeAttribute('disabled');
                    closeButton.style.color = '#000000';
                } else {                    
                    var splits = http.responseText.split('__%__');

                    if (splits[4] == 'found') {
                        confirmButton.value = 'Confirmed';
                        confirmButton.removeAttribute('disabled');
                        confirmButton.style.background = '#009688';
                        confirmButton.style.color = '#fefefe';
                        personalBox.style.transform = 'translateY(0)';
                    
                        customerName.value = splits[0];
                        customerEmail.value = splits[1];

                        openMapButton.innerText = splits[2];
                        customerLocation.value = splits[2];
                        customerLatlng.value = splits[3];

                        if ((customerName.value.length >= 1) && (customerLocation.value.length >= 1)) {
                            finishButton.removeAttribute('disabled');
                            finishButton.style.background = '#009688';
                            finishButton.style.color = '#fefefe';
                        } else {
                            finishButton.setAttribute('disabled', 'disabled');
                            finishButton.style.background = '#dddddd';
                            finishButton.style.color = '#999999';
                        }
                    }
                }
            }, 2000);
        }
    }
    http.send(params);
}

function openMap() {
    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function (event) {
        history.pushState(null, document.title, location.href);
    });
    const mapContainer = document.querySelector(".map-container");
    const defaultMap = document.querySelector("#map");
    const openMapButton = document.querySelector('.open-map-button');
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
    geocodeLatLng(geocoder, map, infowindow, mapContainer, defaultMap, openMapButton, customerLocation, customerLatlng);
}

function geocodeLatLng(geocoder, map, infowindow, mapContainer, defaultMap, openMapButton, customerLocation, customerLatlng) {
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

                            if ((customerLocation.value == '') && (customerLatlng.value == '')) {
                                openMapButton.innerText = results[0].formatted_address;
                                customerLocation.value = results[0].formatted_address;
                                customerLatlng.value = latlng.lat+','+latlng.lng;
                            }

                            if ((customerName.value.length >= 1) && (customerLocation.value.length >= 1)) {
                                finishButton.removeAttribute('disabled');
                                finishButton.style.background = '#009688';
                                finishButton.style.color = '#fefefe';
                            } else {
                                finishButton.setAttribute('disabled', 'disabled');
                                finishButton.style.background = '#dddddd';
                                finishButton.style.color = '#999999';
                            }
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
                                        openMapButton.innerText = results[0].formatted_address;
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

function finishPersonal() {
    finishButton.value = 'Please Wait';
    finishButton.setAttribute('disabled', 'disabled');
    finishButton.style.background = '#dddddd';
    finishButton.style.color = '#999999';
    
    var http = new XMLHttpRequest();
    var url = '../requests/finish-personal.php';
    var params = 'mobile='+mobileNumber.value+'&otp='+otp.value+'&customername='+customerName.value+'&customeremail='+customerEmail.value+'&customerlocation='+customerLocation.value+'&customerlatlng='+customerLatlng.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() {
                finishButton.value = 'Welcome Home';
                finishButton.style.background = '#009688';
                finishButton.style.color = '#fefefe';

                if (http.responseText == 'true') {
                    setTimeout(function() {
                        setTimeout(function() {
                            window.location.href = '../views/food.php';
                        }, 100);
                    }, 2000);
                }
            }, 2000);
        }
    }
    http.send(params);
}