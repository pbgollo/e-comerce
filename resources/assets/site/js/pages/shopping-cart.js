function init() {
    initShoppingCart();

}

function initShoppingCart() {
    const couponInput = document.querySelector('.cart-coupon-area__input');
    const applyCouponBtn = document.querySelector('.cart-coupon-area__button');
    const cepInput = document.querySelector('.cart-delivery-area__input');
    const applyCepBtn = document.querySelector('.cart-delivery-area__button--ok');
    const removeProductBtn = document.querySelector('.cart-product__remove');
    const continueShoppingBtn = document.querySelector('.cart-summary__button--continue');
    const checkoutBtn = document.querySelector('.cart-summary__button--checkout');
    const quantitySelect = document.querySelector('.cart-product__quantity');

    if (applyCouponBtn) {
        applyCouponBtn.addEventListener('click', function () {
            if (couponInput.value.trim() !== '') {
                alert('Aplicar cupom: ' + couponInput.value);
                // Lógica para aplicar cupom
            } else {
                alert('Por favor, insira um cupom.');
            }
        });
    }

    if (applyCepBtn) {
        applyCepBtn.addEventListener('click', function () {
            if (cepInput.value.trim() !== '') {
                alert('Consultar CEP: ' + cepInput.value);
                // Lógica para consultar CEP
            } else {
                alert('Por favor, insira um CEP.');
            }
        });
    }

    if (removeProductBtn) {
        removeProductBtn.addEventListener('click', function () {
            if (confirm('Tem certeza que deseja remover este produto do carrinho?')) {
                alert('Produto removido.');
                // Lógica para remover o produto
                // Pode ser necessário recarregar ou atualizar dinamicamente a página
            }
        });
    }

    if (continueShoppingBtn) {
        continueShoppingBtn.addEventListener('click', function () {
            alert('Continuar comprando...');
            // Redirecionar para a página de produtos ou home
            // window.location.href = '/produtos';
        });
    }

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function () {
            alert('Indo para o pagamento...');
            // Redirecionar para a página de pagamento
            // window.location.href = '/pagamento';
        });
    }

    if (quantitySelect) {
        quantitySelect.addEventListener('change', function () {
            alert('Quantidade alterada para: ' + this.value);
            // Lógica para atualizar a quantidade do produto no carrinho
        });
    }
}

$(function () {
    init();
});
