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
                <a href="#" class="cart-steps__item cart-steps__item--active">Carrinho</a>
                <a href="#" class="cart-steps__item">Identificação</a>
                <a href="#" class="cart-steps__item">Pagamento</a>
                <a href="#" class="cart-steps__item">Confirmação</a>
            </nav>
        </header>
        <div class="cart-page__content">
            <div class="cart-main">
                <div class="cart-product">
                    <div class="cart-product__image-wrapper">
                        <img class="cart-product__image" src="{{ resize($product['image'])}}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="cart-product__details">
                        <p class="cart-product__supplier">Vendido e entregue por: <span>{{ $product['supplier']['name'] }}</span></p>
                        <p class="cart-product__name">{{ $product['name'] }}</p>
                        <p class="cart-product__price-pix">Com desconto no PIX: <span class="cart-product__price-value">RS {{ number_format($product['stock']['promotion_price'], 2, ',', '.') }}</span></p>
                        <p class="cart-product__price-card">Parcela de cartão sem juros: <span class="cart-product__price-value">RS {{ number_format($product['stock']['price'], 2, ',', '.') }}</span></p>
                    </div>
                    <div class="cart-product__actions">
                        <select class="cart-product__quantity">
                            @for ($i = 1; $i <= 5; $i++) {{-- Exemplo: 1 a 5 unidades --}}
                                <option value="{{ $i }}" {{ $product['stock']['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="cart-product__remove">REMOVER</button>
                    </div>
                </div>

                <div class="cart-coupon-area">
                    <input type="text" class="cart-coupon-area__input" placeholder="Cupom de desconto">
                    <button class="cart-coupon-area__button">APLICAR CUPOM</button>
                </div>

                <div class="cart-delivery-area">
                    <input type="text" class="cart-delivery-area__input" placeholder="CEP*">
                    <button class="cart-delivery-area__button cart-delivery-area__button--ok">OK</button>
                    <p class="cart-delivery-area__help-text">Não lembro meu CEP</p>
                </div>
            </div>

            <aside class="cart-summary">
                <h2 class="cart-summary__title">RESUMO</h2>
                <div class="cart-summary__item">
                    <p class="cart-summary__label">Valor dos Produtos:</p>
                    <p class="cart-summary__value">RS {{ number_format($product['stock']['price'], 2, ',', '.') }}</p>
                </div>
                <div class="cart-summary__item">
                    <p class="cart-summary__label">Frete:</p>
                    <p class="cart-summary__value">RS 0.00</p>
                </div>
                <div class="cart-summary__item cart-summary__item--total-installments">
                    <p class="cart-summary__label">Total a prazo:</p>
                    <p class="cart-summary__value">RS {{ number_format($product['stock']['price'], 2, ',', '.') }}</p>
                    <p class="cart-summary__info">(em até 8x de RS {{ number_format($product['stock']['price'] / 8, 2, ',', '.') }} sem juros)</p>
                </div>
                <div class="cart-summary__item cart-summary__item--total-pix">
                    <p class="cart-summary__label">Valor à vista no PIX:</p>
                    <p class="cart-summary__value cart-summary__value--highlight">RS {{ number_format($product['stock']['promotion_price'], 2, ',', '.') }}</p>
                    <p class="cart-summary__economy">(Economize RS {{ number_format($product['stock']['price'] - $product['stock']['promotion_price'], 2, ',', '.') }})</p>
                </div>

                <div class="cart-summary__delivery">
                    <p class="cart-summary__delivery-label">ENTREGA</p>
                </div>

                <div class="cart-summary__actions">
                    <a href = "{{'product/'.$product['slug'].'/cart/payment'}}" class="cart-summary__button cart-summary__button--checkout">IR PARA PAGAMENTO</a>
                    <a href = "" class="cart-summary__button cart-summary__button--continue">CONTINUAR COMPRANDO</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
