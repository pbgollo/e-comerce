@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/checkout.js')) }}"></script>
@endsection

@section('css')
@endsection

@section('content')
    <section class="checkout-section">
        <div class="checkout-container" id="checkoutContainer">
            <header class="checkout-header">
                <nav class="checkout-nav">
                    <a id="cartStepLink" class="checkout-step-item checkout-step-item--active">Carrinho</a>
                    <a id="paymentStepLink" class="checkout-step-item">Pagamento</a>
                </nav>
            </header>

            {{-- Cart Page Section --}}
            <div id="cartPageSection" class="checkout-main-content">
                <div class="cart-section">
                    <h2 class="section-title">Seu Carrinho</h2>
                    <div id="cartItemsList" class="cart-items-list">
                        {{-- Cart items will be injected here by JS --}}
                        <p id="emptyCartMessage" class="empty-cart-message hidden">Seu carrinho está vazio.</p>
                    </div>
                </div>

                <aside class="summary-sidebar">
                    <h2 class="sidebar-title">RESUMO</h2>
                    <div class="summary-details">
                        <div class="summary-line">
                            <p class="summary-label">Valor dos Produtos:</p>
                            <p id="summarySubtotal" class="summary-value">R$ 0,00</p>
                        </div>
                        <div class="summary-line">
                            <p class="summary-label">Frete:</p>
                            <p class="summary-value">R$ 0,00</p>
                        </div>
                        <div class="summary-total-section">
                            <p class="summary-total-label">Total a prazo:</p>
                            <p id="summaryTotalInstallments" class="summary-total-value">R$ 0,00</p>
                            <p id="summaryInstallmentDetails" class="summary-installment-info"></p>
                        </div>
                        <div class="summary-pix-section">
                            <p class="summary-pix-label">Valor à vista no PIX:</p>
                            <p id="summaryPixPrice" class="summary-pix-value">R$ 0,00</p>
                            <p id="summaryEconomy" class="summary-economy-info"></p>
                        </div>
                    </div>
                    <div class="summary-actions">
                        <button id="goToPaymentButton" class="btn btn-primary">IR PARA PAGAMENTO</button>
                        <button onclick="window.location.href = '/'" class="btn btn-secondary">CONTINUAR COMPRANDO</button>
                    </div>
                </aside>
            </div>

            {{-- Payment Page Section --}}
            <div id="paymentPageSection" class="checkout-main-content hidden">
                <main class="payment-section">
                    <h2 class="section-title">FORMA DE PAGAMENTO</h2>

                    <div class="payment-options">
                        <div class="payment-option-card">
                            <label class="payment-option-label">
                                <input type="radio" name="payment_method" value="pix" class="payment-radio" checked>
                                <span class="payment-method-name">PIX</span>
                                <span class="payment-option-icon payment-option-icon--pix"></span>
                            </label>
                            <div class="payment-option-description">
                                <p>Até 15% de desconto com aprovação imediata que torna a expedição mais rápida do pedido.
                                </p>
                            </div>
                        </div>

                        <div class="payment-option-card">
                            <label class="payment-option-label">
                                <input type="radio" name="payment_method" value="boleto" class="payment-radio">
                                <span class="payment-method-name">BOLETO BANCÁRIO</span>
                                <span class="payment-option-icon payment-option-icon--barcode"></span>
                            </label>
                        </div>

                        <div class="payment-option-card">
                            <label class="payment-option-label">
                                <input type="radio" name="payment_method" value="credit_card" class="payment-radio">
                                <span class="payment-method-name">CARTÃO DE CRÉDITO</span>
                                <span class="payment-option-icon payment-option-icon--credit-card"></span>
                            </label>
                        </div>
                    </div>
                </main>

                <aside class="summary-sidebar">
                    <h2 class="sidebar-title">VALOR DA COMPRA</h2>
                    <div class="summary-details">
                        <div class="summary-line">
                            <p class="summary-label">Total da compra:</p>
                            <p id="paymentSubtotal" class="summary-value">R$ 0,00</p>
                        </div>
                        <div class="summary-pix-section">
                            <p class="summary-pix-label">Pagamento via Pix:</p>
                            <p id="paymentPixPrice" class="summary-pix-value">R$ 0,00</p>
                            <p id="paymentEconomy" class="summary-economy-info"></p>
                        </div>
                    </div>
                    <div class="summary-actions">
                        <button id="createOrderButton" class="btn btn-success">CRIAR PEDIDO</button>
                        <button id="backToCartButton" class="btn btn-secondary">VOLTAR</button>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
