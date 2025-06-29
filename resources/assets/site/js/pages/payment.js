function init() {
    initPaymentPage();

}
function initPaymentPage() {
    const paymentOptions = document.querySelectorAll('.payment-option__radio');
    const continueButton = document.querySelector('.payment-summary__button--continue');
    const backButton = document.querySelector('.payment-summary__button--back');

    // Adiciona listener para mudança na seleção da forma de pagamento
    paymentOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Lógica para lidar com a mudança da forma de pagamento
            console.log('Forma de pagamento selecionada:', this.value);
            // Aqui você pode, por exemplo, atualizar o resumo da compra com base na forma de pagamento
        });
    });

    if (continueButton) {
        continueButton.addEventListener('click', function () {
            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (selectedPaymentMethod) {
                alert('Prosseguindo com o pagamento via: ' + selectedPaymentMethod.value.toUpperCase());
                // Redirecionar para a próxima etapa (Confirmação, por exemplo)
                // window.location.href = '/confirmacao';
            } else {
                alert('Por favor, selecione uma forma de pagamento.');
            }
        });
    }

    if (backButton) {
        backButton.addEventListener('click', function () {
            alert('Voltando para a tela anterior (Carrinho)...');
            // Redirecionar para a tela anterior
            // window.location.href = '/carrinho';
        });
    }
}

$(function () {
    init();
});
