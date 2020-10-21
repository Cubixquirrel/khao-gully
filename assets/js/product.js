function isBetween(n, a, b) {
    return (n - a) * (n - b) <= 0
}

bajb_backdetect.OnBack = function() {
    var cartPage = document.querySelector('.cart-page');
    if (cartPage.getAttribute('style') == 'transform: translateY(0px);') {
        history.pushState(null, document.title, location.href+'#b');
        hideCart();
    }
}

function pageBack() {
    window.history.back();
}

function openRestaurantInfo(productId) {
    window.location.href = '../views/restaurant-info.php?productId='+productId;
}

var foodAddButton = document.querySelectorAll('.food-add-button');
for (var i = 0; i < foodAddButton.length; i++) {
    if (foodAddButton[i].getAttribute('data-quantity') == '0') {
        
        var foodId = foodAddButton[i].getAttribute('data-id');

        foodAddButton[i].setAttribute('onclick', 'addFoodQuantity("'+foodId+'")');
    }
}

function addFoodQuantity(foodId) {
    var clickedAddButton = document.querySelector('[data-id="'+foodId+'"]');
    var clickedButtonQuantity = clickedAddButton.getAttribute('data-quantity');
    var clickedButtonPrice = clickedAddButton.getAttribute('data-price');
    var minusButton = clickedAddButton.querySelector('.minus');
    var plusButton = clickedAddButton.querySelector('.plus');
    var display = clickedAddButton.querySelector('.display');
    var cartBox = document.querySelector('.cart-box');
    var cartItem = document.querySelector('#cart-item');
    var cartPrice = document.querySelector('#cart-price');
    var space = document.querySelector('.space');
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var grandTotal = document.querySelector('.grand-total');
    var riderTip = document.querySelector('.rider-tip');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    clickedAddButton.setAttribute('data-quantity', parseInt(clickedButtonQuantity) + 1);
    cartItem.innerHTML = parseInt(cartItem.innerHTML) + 1;
    cartPrice.innerHTML = parseInt(cartPrice.innerHTML) + parseInt(clickedButtonPrice);
    itemTotal.innerHTML = cartPrice.innerHTML;
    taxesCharges.innerHTML = parseInt(itemTotal.innerHTML) * 18 / 100;
    deliveryCharges.innerHTML = parseInt(20);
    safetyPackaging.innerHTML = parseInt(4);
    grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);

    if (clickedButtonQuantity == '0') {
        space.style.height = '80px';
        clickedAddButton.removeAttribute('onclick');
        clickedAddButton.style.border = '1px solid #000000';
        cartBox.style.transform = 'translateY(0)';
        display.innerHTML = '1';
        // display.style.background = '#FFFDE7';
        minusButton.innerHTML = '-';
        minusButton.style.width = '70px';
        minusButton.setAttribute('onclick', "minusFoodQuantity('"+foodId+"')");
        plusButton.setAttribute('onclick', "addFoodQuantity('"+foodId+"')");
    } else {
        display.innerHTML = parseInt(display.innerHTML) + 1;
    }

    applyWallet();
}

function minusFoodQuantity(foodId) {
    var clickedAddButton = document.querySelector('[data-id="'+foodId+'"]');
    var clickedButtonQuantity = clickedAddButton.getAttribute('data-quantity');
    var clickedButtonPrice = clickedAddButton.getAttribute('data-price');
    var minusButton = clickedAddButton.querySelector('.minus');
    var plusButton = clickedAddButton.querySelector('.plus');
    var display = clickedAddButton.querySelector('.display');
    var cartBox = document.querySelector('.cart-box');
    var cartItem = document.querySelector('#cart-item');
    var cartPrice = document.querySelector('#cart-price');
    var space = document.querySelector('.space');
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var grandTotal = document.querySelector('.grand-total');
    var riderTipBox = document.querySelector('.rider-tip-box');
    var riderTip = document.querySelector('.rider-tip');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    clickedAddButton.setAttribute('data-quantity', parseInt(clickedButtonQuantity) - 1);
    cartItem.innerHTML = parseInt(cartItem.innerHTML) - 1;
    cartPrice.innerHTML = parseInt(cartPrice.innerHTML) - parseInt(clickedButtonPrice);
    itemTotal.innerHTML = cartPrice.innerHTML;
    taxesCharges.innerHTML = parseInt(itemTotal.innerHTML) * 18 / 100;
    deliveryCharges.innerHTML = parseInt(20);
    safetyPackaging.innerHTML = parseInt(4);
    grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);

    if (cartItem.innerHTML == '0') {
        removePromo();
        space.style.height = '0';
        cartBox.style.transform = 'translateY(120%)';
        riderTipBox.style.display = 'none';
        riderTip.innerHTML = 0;
        grandTotal.innerHTML = 0;
        cartFooterTotal.innerHTML = 0;
    }

    if (couponCodeValue.getAttribute('data-min-value') !== null) {
        if (parseInt(itemTotal.innerHTML) < parseInt(couponCodeValue.getAttribute('data-min-value'))) {
            removePromo();
        }
    }

    if (clickedButtonQuantity == '1') {
        minusButton.removeAttribute('onclick');
        plusButton.removeAttribute('onclick');
        clickedAddButton.style.border = '1px solid #dddddd';
        // display.style.background = '#fefefe';
        display.innerHTML = 'ADD';
        minusButton.innerHTML = '';
        minusButton.style.width = '0px';
        plusButton.setAttribute('onclick', "addFoodQuantity('"+foodId+"')");
    } else {
        display.innerHTML = parseInt(display.innerHTML) - 1;
    }

    applyWallet();
}

function applyWallet() {
    var cartBox = document.querySelector('.cart-box');

    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var riderTip = document.querySelector('.rider-tip');
    var grandTotal = document.querySelector('.grand-total');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    var yourSavingsBox = document.querySelector('.your-savings-box');
    var totalSavings = document.querySelector('#total-savings');
    var yourWalletBox = document.querySelector('.your-wallet-box');
    var walletToFrom = document.querySelector('.wallet-to-from');
    var walletSavings = document.querySelector('#wallet-savings');
    var walletCash = document.querySelector('#wallet-cash');

    var walletValue = '';
    if ((parseInt(itemTotal.innerHTML) > 1) && (parseInt(itemTotal.innerHTML) < 100)) {
        // console.log('wallet cashback 40');
        cartBox.setAttribute('data-wallet', 'true');
        toFrom = 'TO';
        walletValue = '40';
    } else {
        // console.log('no cashback');
        cartBox.setAttribute('data-wallet', 'false');
        toFrom = 'FROM';
        
        var i = 100;
        for (var x = 0; x < 35; x++) {
            if (isBetween(parseInt(itemTotal.innerHTML), i, i + 40) === true) {
                console.log('Amount: ' + parseInt(itemTotal.innerHTML));
                console.log('Range Series: ' + parseInt(x + 1));
                console.log('Range: ' + i, i + 40);
                console.log('Status: ' + isBetween(parseInt(itemTotal.innerHTML), i, i + 40));

                walletValue = parseInt(x + 1) * 10;
            }
            i = i + 40;
        }
        console.log('Wallet Cashback: ' + walletValue);
        console.log('Wallet Cash: ' + walletCash.value);

        console.log(parseInt(walletCash.value) < parseInt(walletValue));
        if (parseInt(walletCash.value) < parseInt(walletValue)) {
            walletValue = walletCash.value;
        }

        console.log('Wallet Value: ' + walletValue);
        // walletValue = '10';
    }

    if ((totalSavings.innerHTML == '') || (totalSavings.innerHTML == '0')) {
        if (toFrom == 'TO') {
            cartBox.setAttribute('data-wallet-value', walletValue);
            yourWalletBox.style.display = 'flex';
            walletToFrom.innerHTML = toFrom;
            walletSavings.innerHTML = walletValue;
        } else if (toFrom == 'FROM') {
            if (parseInt(walletCash.value) != 0) {
                cartBox.setAttribute('data-wallet-value', walletValue);
                yourWalletBox.style.display = 'flex';
                walletToFrom.innerHTML = toFrom;
                walletSavings.innerHTML = walletValue;

                grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
                cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
            } else {
                removeWallet();
            }
        }
    } else {
        removeWallet();
    }
}

function removeWallet() {
    var cartBox = document.querySelector('.cart-box');

    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var riderTip = document.querySelector('.rider-tip');
    var grandTotal = document.querySelector('.grand-total');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    var yourSavingsBox = document.querySelector('.your-savings-box');
    var totalSavings = document.querySelector('#total-savings');
    var yourWalletBox = document.querySelector('.your-wallet-box');
    var walletToFrom = document.querySelector('.wallet-to-from');
    var walletSavings = document.querySelector('#wallet-savings');
    var walletCash = document.querySelector('#wallet-cash');

    cartBox.removeAttribute('data-wallet-value');
    yourWalletBox.style.display = 'none';
    walletToFrom.innerHTML = '';
    walletSavings.innerHTML = '';

    // grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(riderTip.innerHTML) + parseFloat(walletSavings.innerHTML)).toFixed(2);
    // cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(riderTip.innerHTML) + parseFloat(walletSavings.innerHTML)).toFixed(2);
}

function openCart(restaurantId) {
    console.log(location.hash)
    if (location.hash == '') {
        history.pushState(null, document.title, location.href+'#b');
    }
    var cartPage = document.querySelector('.cart-page');
    if (cartPage.getAttribute('style') == 'transform: translateY(0px);') {
        hideCart();
    }

    var dataQuantity = document.querySelectorAll('[data-quantity]');
    var cartPage = document.querySelector('.cart-page');
    var body = document.querySelector('body');
    var shadowMain = document.querySelector('.shadow-main');
    var cartFoodList = document.querySelector('.cart-food-list');
    var id = '', name = '', price = '', quantity = '';

    for (var i = 0; i < dataQuantity.length; i++) {
        if (dataQuantity[i].getAttribute('data-quantity') > '0') {
            // console.log(dataQuantity[i]);

            if (id != '') {id  += '__%__'}
            id += dataQuantity[i].getAttribute('data-id');

            if (name != '') {name  += '__%__'}
            name += dataQuantity[i].getAttribute('data-name');

            if (price != '') {price  += '__%__'}
            price += dataQuantity[i].getAttribute('data-price');

            if (quantity != '') {quantity  += '__%__'}
            quantity += dataQuantity[i].getAttribute('data-quantity');
        }
    }

    body.style.overflow = 'hidden';
    shadowMain.style.display = 'block';
    cartPage.style.transform = 'translateY(0)';

    var names      = name.split('__%__');
    var quantities = quantity.split('__%__');
    var prices     = price.split('__%__');
    var ids        = id.split('__%__');    

    names.forEach(addFoodListName);
    quantities.forEach(addFoodListQuantity);
    prices.forEach(addFoodListPrice);
    // ids.forEach(addFoodId);

    function addFoodListName(item) {
        var cartSingle = document.createElement('div');
        var cartFoodName = document.createElement('span')

        cartSingle.setAttribute('class', 'cart-food-single-list');
        cartFoodName.setAttribute('class', 'cart-food-name');

        cartSingle.appendChild(cartFoodName);
        cartFoodList.appendChild(cartSingle);

        cartFoodName.innerHTML += item;
        cartFoodName.parentNode.setAttribute('data-food-name', item);
    }

    function addFoodListQuantity(item) {
        var cartSingle = document.querySelector('.cart-food-single-list');
        var cartFoodQuantity = document.createElement('span');

        cartFoodQuantity.setAttribute('class', 'cart-food-quantity');

        cartSingle.appendChild(cartFoodQuantity);
        cartFoodList.appendChild(cartSingle);

        cartFoodQuantity.innerHTML += item;
        cartFoodQuantity.parentNode.setAttribute('data-food-quantity', item);
    }

    function addFoodListPrice(item) {
        var cartSingle = document.querySelector('.cart-food-single-list');
        var cartFoodName = document.querySelector('.cart-food-name');
        var cartFoodQuantity = document.querySelector('.cart-food-quantity');
        var cartFoodPrice = document.createElement('span');
        var cartFoodTotalPrice = document.createElement('span');

        cartFoodPrice.setAttribute('class', 'cart-food-price');
        cartFoodTotalPrice.setAttribute('class', 'cart-food-total-price');

        cartSingle.appendChild(cartFoodPrice);
        cartFoodName.appendChild(cartFoodTotalPrice);
        cartFoodList.appendChild(cartSingle);

        cartFoodPrice.innerHTML += item;
        var totalPrice  = parseInt(cartFoodQuantity.innerHTML) * parseInt(cartFoodPrice.innerHTML);
        cartFoodTotalPrice.innerHTML += totalPrice;
        cartFoodPrice.parentNode.setAttribute('data-food-price', item);
    }

    var cartSingle = document.querySelectorAll('.cart-food-single-list');
    for (var i = 0; i < cartSingle.length; i++) {
        cartSingle[i].setAttribute('data-food-id', ids[i]);
    }
}

function hideCart() {
    var cartPage = document.querySelector('.cart-page');
    var body = document.querySelector('body');
    var shadowMain = document.querySelector('.shadow-main');
    var cartFoodList = document.querySelector('.cart-food-list');
    var paymentPage = document.querySelector('.payment-page');

    body.style.overflow = '';
    shadowMain.style.display = 'none';
    cartPage.style.transform = 'translateY(120%)';
    cartFoodList.innerHTML = '';
    paymentPage.style.transform = 'translateY(120%)';
}

function addTips(amount) {
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var grandTotal = document.querySelector('.grand-total');
    var riderTipBox = document.querySelector('.rider-tip-box');
    var riderTip = document.querySelector('.rider-tip');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    var totalSavings = document.querySelector('#total-savings');
    var walletToFrom = document.querySelector('.wallet-to-from');
    var walletSavings = document.querySelector('#wallet-savings');

    riderTipBox.style.display = 'flex';
    riderTip.innerHTML = amount;
    
    if ((totalSavings.innerHTML == '') || (totalSavings.innerHTML == '0')) {
        if (walletToFrom.innerHTML == 'FROM') {
            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
        } else {
            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        }
    } else {
        grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    }
}

function removeTips() {
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var grandTotal = document.querySelector('.grand-total');
    var riderTipBox = document.querySelector('.rider-tip-box');
    var riderTip = document.querySelector('.rider-tip');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    var totalSavings = document.querySelector('#total-savings');
    var walletToFrom = document.querySelector('.wallet-to-from');
    var walletSavings = document.querySelector('#wallet-savings');

    riderTipBox.style.display = 'none';
    riderTip.innerHTML = 0;

    if ((totalSavings.innerHTML == '') || (totalSavings.innerHTML == '0')) {
        if (walletToFrom.innerHTML == 'FROM') {
            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(walletSavings.innerHTML)).toFixed(2);
        } else {
            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        }
    } else {
        grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    }
}

function capitalLetter() {
    var promoInput = document.querySelector('[name="promo-input"]');
    var promoButton = document.querySelector('.promo-button');

    promoInput.value = promoInput.value.toUpperCase();
    promoButton.value = 'Apply';
    promoButton.style.color = '#F44336';
    promoButton.removeAttribute('disabled');
}

function applyPromo() {
    var promoInput = document.querySelector('[name="promo-input"]');
    var promoButton = document.querySelector('.promo-button');

    var itemTotal = document.querySelector('.item-total');

    if (promoInput.value.length > 0) {    
        promoButton.value = 'Applying...';
        promoButton.style.color = '#666666';
        promoButton.setAttribute('disabled', 'disabled');

        var http = new XMLHttpRequest();
        var url = '../requests/apply-promo.php';
        var params = 'couponCode='+promoInput.value+'&itemTotal='+itemTotal.innerHTML;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                setTimeout(function() {
                    var responses = (http.responseText).split('__%__');

                    if (responses[0] == 'false') {
                        promoButton.style.color = '#F44336';
                        promoButton.value = responses[1];
                    }
                    else {
                        removeWallet();
                        promoButton.value = 'Coupon Added';
                        promoButton.style.color = '#F44336';

                        var couponCodeBox = document.querySelector('.coupon-code-box');
                        var couponCodeName = document.querySelector('.coupon-code-name');
                        var couponCodeValue = document.querySelector('.coupon-code-value');

                        couponCodeBox.style.display = 'flex';
                        
                        var responses = http.responseText;
                        var response = responses.split('__%__');
                        var responseCouponCode = response[0];
                        var responseCouponType = response[1];
                        var responseCouponValue = response[2];
                        var responseMinValue = response[3];

                        couponCodeName.innerHTML = responseCouponCode;
                        couponCodeValue.setAttribute('data-min-value', responseMinValue);

                        var itemTotal = document.querySelector('.item-total');
                        var taxesCharges = document.querySelector('.taxes-charges');
                        var deliveryCharges = document.querySelector('.delivery-charges');
                        var safetyPackaging = document.querySelector('.safety-packaging');
                        var riderTip = document.querySelector('.rider-tip');
                        var grandTotal = document.querySelector('.grand-total');
                        var cartFooterTotal = document.querySelector('.cart-footer-total');

                        // itemTotal.addEventListener('DOMSubtreeModified', updatePromo);

                        if (responseCouponType == 'Percentage') {
                            couponCodeBox.setAttribute('data-coupon-type', responseCouponType);
                            couponCodeBox.setAttribute('data-coupon-value', responseCouponValue);
                            couponCodeValue.innerHTML = parseInt(itemTotal.innerHTML) * parseFloat(responseCouponValue / 100);                            
                            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
                            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
                        }
                        else if (responseCouponType == 'Fixed') {
                            couponCodeBox.setAttribute('data-coupon-type', responseCouponType);
                            couponCodeBox.setAttribute('data-coupon-value', responseCouponValue);
                            couponCodeValue.innerHTML = responseCouponValue;
                            grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
                            cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
                        }

                        var yourSavingsBox = document.querySelector('.your-savings-box');
                        var totalSavings = document.querySelector('#total-savings');

                        yourSavingsBox.style.display = 'flex';
                        totalSavings.innerHTML = couponCodeValue.innerHTML;
                    }
                }, 2000);
            }
        }
        http.send(params);
    }
}

function updatePromo() {
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var riderTip = document.querySelector('.rider-tip');
    var grandTotal = document.querySelector('.grand-total');
    var cartFooterTotal = document.querySelector('.cart-footer-total');
    
    var couponCodeBox = document.querySelector('.coupon-code-box');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var couponType = couponCodeBox.getAttribute('data-coupon-type');
    var couponValue = couponCodeBox.getAttribute('data-coupon-value');

    if (couponType == 'Percentage') {
        couponCodeValue.innerHTML = parseInt(itemTotal.innerHTML) * couponValue / 100;
        grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    }
    else if (couponType == 'Fixed') {
        couponCodeValue.innerHTML = couponValue;
        grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
        cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    }

    var totalSavings = document.querySelector('#total-savings');
    totalSavings.innerHTML = couponCodeValue.innerHTML;
}

function removePromo() {
    var promoInput = document.querySelector('[name="promo-input"]');
    var promoButton = document.querySelector('.promo-button');
    var couponCodeBox = document.querySelector('.coupon-code-box');
    var couponCodeName = document.querySelector('.coupon-code-name');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    
    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var riderTip = document.querySelector('.rider-tip');
    var grandTotal = document.querySelector('.grand-total');
    var cartFooterTotal = document.querySelector('.cart-footer-total');

    promoInput.value = '';
    promoButton.value = 'Apply';
    promoButton.style.color = '#F44336';
    promoButton.removeAttribute('disabled');

    couponCodeBox.style.display = 'none';
    couponCodeBox.removeAttribute('data-coupon-type');
    couponCodeBox.removeAttribute('data-coupon-value');

    couponCodeName.innerHTML = '';
    couponCodeValue.innerHTML = '0';
    couponCodeValue.removeAttribute('data-min-value');

    grandTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);
    cartFooterTotal.innerHTML = parseFloat(parseInt(itemTotal.innerHTML) + parseFloat(taxesCharges.innerHTML) + parseInt(deliveryCharges.innerHTML) + parseInt(safetyPackaging.innerHTML) + parseInt(riderTip.innerHTML) - parseFloat(couponCodeValue.innerHTML)).toFixed(2);

    var yourSavingsBox = document.querySelector('.your-savings-box');
    var totalSavings = document.querySelector('#total-savings');

    yourSavingsBox.style.display = 'none';
    totalSavings.innerHTML = '';
}

function openPaymentPage() {
    var paymentPage = document.querySelector('.payment-page');
    // console.log(paymentPage.style.transformY)
    paymentPage.style.transform = 'translateY(0)';
}

function closePaymentPage() {
    var paymentPage = document.querySelector('.payment-page');

    paymentPage.style.transform = 'translateY(120%)';
}

function setPaymentType(type) {
    var paymentPage = document.querySelector('.payment-page');
    var paymentType = document.querySelector('.payment-type');

    paymentType.innerHTML = type;
    paymentPage.style.transform = 'translateY(120%)';
}

function createOrder(restaurantId, userId, userLocation, userName, userMobile) {
    // console.log('Restaurant Id: '+restaurantId);

    var cartSingle = document.querySelectorAll('.cart-food-single-list');
    var foodId = '', foodName = '', foodQuantity = '', foodPrice = '';
    for (var i = 0; i < cartSingle.length; i++) {
        if ((foodId == '') && (foodName == '') && (foodQuantity == '') && (foodPrice == '')) {
            foodId = cartSingle[i].getAttribute('data-food-id');
            foodName = cartSingle[i].getAttribute('data-food-name');        
            foodQuantity = cartSingle[i].getAttribute('data-food-quantity');
            foodPrice = cartSingle[i].getAttribute('data-food-price');
        } else {
            foodId = foodId + '__%__' + cartSingle[i].getAttribute('data-food-id');
            foodName = foodName + '__%__' + cartSingle[i].getAttribute('data-food-name');        
            foodQuantity = foodQuantity + '__%__' + cartSingle[i].getAttribute('data-food-quantity');
            foodPrice = foodPrice + '__%__' + cartSingle[i].getAttribute('data-food-price');
        }
    }
    // console.log('Food Id: '+foodId);
    // console.log('Food Name: '+foodName);
    // console.log('Food Quantity: '+foodQuantity);
    // console.log('Food Price: '+foodPrice);

    var itemTotal = document.querySelector('.item-total');
    var taxesCharges = document.querySelector('.taxes-charges');
    var deliveryCharges = document.querySelector('.delivery-charges');
    var safetyPackaging = document.querySelector('.safety-packaging');
    var riderTip = document.querySelector('.rider-tip');    
    var couponCodeName = document.querySelector('.coupon-code-name');
    var couponCodeValue = document.querySelector('.coupon-code-value');
    var grandTotal = document.querySelector('.grand-total');

    // console.log('Item Total: '+itemTotal.innerHTML);
    // console.log('Taxes & Charges: '+taxesCharges.innerHTML);
    // console.log('Rider Tip: '+riderTip.innerHTML);
    // console.log('Coupon Code: '+couponCodeName.innerHTML);
    // console.log('Coupon Value: '+couponCodeValue.innerHTML);
    // console.log('Grand Total: '+grandTotal.innerHTML);

    var paymentType = document.querySelector('.payment-type');

    var walletToFrom = document.querySelector('.wallet-to-from');
    var walletSavings = document.querySelector('#wallet-savings');

    // console.log('Payment Type: '+paymentType.innerHTML);

    // console.log('User Id: '+userId);
    // console.log('User Location: '+userLocation);
    // console.log('User Name: '+userName);
    // console.log('User Mobile: '+userMobile);

    var http = new XMLHttpRequest();
    var url = '../requests/create-order.php';
    var params = 
    'restaurantId='+restaurantId+
    '&foodId='+foodId+
    '&foodName='+foodName+
    '&foodQuantity='+foodQuantity+
    '&foodPrice='+foodPrice+
    '&itemTotal='+itemTotal.innerHTML+
    '&taxesCharges='+taxesCharges.innerHTML+
    '&deliveryCharges='+deliveryCharges.innerHTML+
    '&safetyPackaging='+safetyPackaging.innerHTML+
    '&riderTip='+riderTip.innerHTML+
    '&couponCodeName='+couponCodeName.innerHTML+
    '&couponCodeValue='+couponCodeValue.innerHTML+
    '&walletToFrom='+walletToFrom.innerHTML+
    '&walletSavings='+walletSavings.innerHTML+
    '&grandTotal='+grandTotal.innerHTML+
    '&paymentType='+paymentType.innerHTML+
    '&userId='+userId+
    '&userLocation='+userLocation+
    '&userName='+userName+
    '&userMobile='+userMobile
    ;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            console.log(http.responseText);

            if (http.responseText == 'Order Placed') {
                window.location.href = '../views/order-success.php';
            } else if (http.responseText == 'Order Failed') {
                window.location.href = '../views/order-failed.php';
            }
        }
    }
    http.send(params);
}