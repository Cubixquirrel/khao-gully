function openOrderPage() {
    var orderButton = document.querySelector('.order-button');
    orderButton.removeAttribute('onclick');
    orderButton.style.background = '#dddddd';
    orderButton.style.color = '#999999';
    orderButton.innerHTML = 'Please Wait';
    
    setTimeout(() => {
        window.location.href = '../views/your-orders.php';
    }, 2000);
}

function openFoodPage() {
    window.location.href = '../views/food.php';
}