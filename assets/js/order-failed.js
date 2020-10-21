function retryOrder() {
    var orderButton = document.querySelector('.order-button');
    orderButton.removeAttribute('onclick');
    orderButton.style.background = '#dddddd';
    orderButton.style.color = '#999999';
    orderButton.innerHTML = 'Please Wait';
    
    setTimeout(() => {
        orderButton.innerHTML = 'Failed';
    }, 2000);
}

function openFoodPage() {
    window.location.href = '../views/food.php';
}