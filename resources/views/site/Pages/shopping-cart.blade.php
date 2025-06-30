@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/shopping-cart.js')) }}"></script>
@endsection

@section('css')
@endsection

@section('content')
    <section class="cart-page">
        <header class="cart-page__header">
            <nav class="cart-steps">
                <a class="cart-steps__item cart-steps__item--active">Carrinho</a>
                <a class="cart-steps__item">Pagamento</a>
                <a class="cart-steps__item">Confirmação</a>
            </nav>
        </header>

        @php
            $price = $product['stock']['price'];
            $promotionActive = $product['stock']['promotion_active'] ?? 0;
            $promotionPrice = $product['stock']['promotion_price'];
            $basePriceForPix = $promotionActive ? $promotionPrice : $price;
            $pixPrice = $basePriceForPix * 0.85;
            $economy = $price - $pixPrice;
            $installments = 8;
            $installmentValue = $price / $installments;
        @endphp

        <div class="cart-page__content">
            <div class="cart-main">
                <div class="cart-product">
                    <div class="cart-product__image-wrapper">
                        <img class="cart-product__image" src="{{ resize($product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="cart-product__details">
                        <p class="cart-product__supplier">Vendido e entregue por:
                            <span>{{ $product['supplier']['name'] }}</span>
                        </p>
                        <p class="cart-product__name">{{ $product['name'] }}</p>

                        <p class="cart-product__price-pix">
                            Com desconto no PIX:
                            <span class="cart-product__price-value">R$ {{ number_format($pixPrice, 2, ',', '.') }}</span>
                        </p>

                        <p class="cart-product__price-card">
                            Parcela de cartão sem juros:
                            <span class="cart-product__price-value">R$ {{ number_format($price, 2, ',', '.') }}</span>
                        </p>
                    </div>
                    <div class="cart-product__actions">
                        <select class="cart-product__quantity">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ $product['stock']['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="cart-product__remove">REMOVER</button>
                    </div>
                </div>

                {{-- Cupom e entrega desativados
                <div class="cart-coupon-area">
                    <input type="text" class="cart-coupon-area__input" placeholder="Cupom de desconto">
                    <button class="cart-coupon-area__button">APLICAR CUPOM</button>
                </div>

                <div class="cart-delivery-area">
                    <input type="text" class="cart-delivery-area__input" placeholder="CEP*">
                    <button class="cart-delivery-area__button cart-delivery-area__button--ok">OK</button>
                    <p class="cart-delivery-area__help-text">Não lembro meu CEP</p>
                </div>
                --}}
            </div>

            <aside class="cart-summary">
                <h2 class="cart-summary__title">RESUMO</h2>

                <div class="cart-summary__item">
                    <p class="cart-summary__label">Valor dos Produtos:</p>
                    <p class="cart-summary__value">R$ {{ number_format($price, 2, ',', '.') }}</p>
                </div>

                <div class="cart-summary__item">
                    <p class="cart-summary__label">Frete:</p>
                    <p class="cart-summary__value">R$ 0,00</p>
                </div>

                <div class="cart-summary__item cart-summary__item--total-installments">
                    <p class="cart-summary__label">Total a prazo:</p>
                    <p class="cart-summary__value">R$ {{ number_format($price, 2, ',', '.') }}</p>
                    <p class="cart-summary__info">(em até {{ $installments }}x de R$
                        {{ number_format($installmentValue, 2, ',', '.') }} sem juros)</p>
                </div>

                <div class="cart-summary__item cart-summary__item--total-pix">
                    <p class="cart-summary__label">Valor à vista no PIX:</p>
                    <p class="cart-summary__value cart-summary__value--highlight">R$
                        {{ number_format($pixPrice, 2, ',', '.') }}</p>
                    <p class="cart-summary__economy">(Economize R$
                        {{ number_format($economy, 2, ',', '.') }})</p>
                </div>

                <div class="cart-summary__delivery">
                    <p class="cart-summary__delivery-label"></p>
                </div>

                <div class="cart-summary__actions">
                    <a href="{{ 'product/' . $product['slug'] . '/cart/payment' }}"
                        class="cart-summary__button cart-summary__button--checkout">IR PARA PAGAMENTO</a>
                    <a href="" class="cart-summary__button cart-summary__button--continue">CONTINUAR COMPRANDO</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
