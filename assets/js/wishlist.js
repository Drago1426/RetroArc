function addToWishlist(productId) {
    // Create an AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_wishlist.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Handle the response
    xhr.onload = function() {
        if (this.status == 200) {
            alert(this.responseText);
        }
    };

    // Send the request
    xhr.send('productId=' + productId);
}

function addToCart(productId) {
    // Create an AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Handle the response
    xhr.onload = function() {
        if (this.status == 200) {
            alert(this.responseText);
        }
    };

    // Send the request
    xhr.send('productId=' + productId);
}