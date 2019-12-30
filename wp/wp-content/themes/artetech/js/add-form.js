let checkinContainer = document.getElementById('client-checkin');
let checkoutContainer = document.getElementById('client-checkout');
checkoutContainer.classList.add('hide');

document.getElementById('checkin-btn').addEventListener('click', function () {
    checkinContainer.classList.remove('hide');
    checkoutContainer.classList.add('hide');
})

document.getElementById('checkout-btn').addEventListener('click', function () {
    checkinContainer.classList.add('hide');
    checkoutContainer.classList.remove('hide');
})