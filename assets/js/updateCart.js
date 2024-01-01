document.querySelectorAll('.update-cart-form').forEach(form => {
    console.log("Form event listener attached");
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var productId = this.querySelector('input[name="productId"]').value;
        var quantityInput = document.querySelector('input[data-product-id="' + productId + '"]');
        if (quantityInput) {
            this.querySelector('.quantity-input').value = quantityInput.value;
            this.submit();
        }
    });
});