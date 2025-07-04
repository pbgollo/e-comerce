@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/payment.js')) }}"></script>
@endsection

@section('css')
@endsection

@section('content')
    @php
        $price = $product['stock']['price'];
        $promotionActive = $product['stock']['promotion_active'] ?? 0;
        $promotionPrice = $product['stock']['promotion_price'];
        $basePriceForPix = $promotionActive ? $promotionPrice : $price;
        $pixPrice = $basePriceForPix * 0.85;
        $economy = $price - $pixPrice;
    @endphp

    <section class="payment-page">
        <header class="payment-page__header">
            <nav class="cart-steps">
                <a class="cart-steps__item">Carrinho</a>
                <a class="cart-steps__item cart-steps__item--active">Pagamento</a>
                <a class="cart-steps__item">Confirmação</a>
            </nav>
        </header>

        <div class="payment-page__content">
            <main class="payment-main">
                <h2 class="payment-main__title">FORMA DE PAGAMENTO</h2>

                <div class="payment-option">
                    <label class="payment-option__label">
                        <input type="radio" name="payment_method" value="pix" class="payment-option__radio" checked>
                        <span class="payment-option__name">PIX</span>
                        <span class="payment-option__icon payment-option__icon--pix"></span>
                    </label>
                    <div class="payment-option__details">
                        <p class="payment-option__info">
                            Até 15% de desconto com aprovação imediata que torna a expedição mais rápida do pedido.
                        </p>
                    </div>
                </div>

                <div class="payment-option">
                    <label class="payment-option__label">
                        <input type="radio" name="payment_method" value="boleto" class="payment-option__radio">
                        <span class="payment-option__name">BOLETO BANCÁRIO</span>
                        <span class="payment-option__icon payment-option__icon--barcode"></span>
                    </label>
                </div>

                <div class="payment-option">
                    <label class="payment-option__label">
                        <input type="radio" name="payment_method" value="credit_card" class="payment-option__radio">
                        <span class="payment-option__name">CARTÃO DE CRÉDITO</span>
                        <span class="payment-option__icon payment-option__icon--credit-card"></span>
                    </label>
                </div>
            </main>

            <aside class="payment-summary">
                <h2 class="payment-summary__title">VALOR DA COMPRA</h2>

                <div class="payment-summary__total-value">
                    <p class="payment-summary__label">Total da compra</p>
                    <p class="payment-summary__value">R$ {{ number_format($price, 2, ',', '.') }}</p>
                </div>

                <div class="payment-summary__pix-info">
                    <p class="payment-summary__pix-label">Pagamento via Pix:</p>
                    <p class="payment-summary__pix-value">R$ {{ number_format($pixPrice, 2, ',', '.') }}</p>
                    <p class="payment-summary__pix-economy">(Economize R$ {{ number_format($economy, 2, ',', '.') }})</p>
                </div>

                <div class="payment-summary__actions">
                    <button class="payment-summary__button payment-summary__button--continue">CRIAR PEDIDO</button>
                    <button class="payment-summary__button payment-summary__button--back">VOLTAR</button>
                </div>
            </aside>
        </div>
    </section>
@endsection
