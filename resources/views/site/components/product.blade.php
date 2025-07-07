@foreach ($products as $product)
    <a href="product/{{ $product['slug'] }}" class = "product js-product"
        data-category = "{{ $product['category_id'] }}" data-id = "{{ $product['id'] }}">
        <div class = "product__top">
            @if ($product['stock']['promotion_active'] == 1)
                <div class = "product__top__promo-label">
                    <p>{{ $product['stock']['promotion_label'] }}</p>
                </div>
            @endif
        </div>
        <div class = "product__middle">
            <div class = "product__middle__image">
                <img src="{{ resize($product['image']) }}" alt="">
            </div>
            <div class = "product__middle__sale-label">
                @if ($product['stock']['promotion_active'] == '')
                    <div class = "product__middle__sale-label__bg">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                            xmlns="https://www.w3.org/2000/svg" class="IconTruck">
                            <path
                                d="M20.1818 7.5H17.4545V5.25C17.4545 4.0125 16.4727 3 15.2727 3H2.18182C0.981818 3 0 4.0125 0 5.25V15.375C0 16.6125 0.981818 17.625 2.18182 17.625C2.18182 19.4925 3.64364 21 5.45455 21C7.26545 21 8.72727 19.4925 8.72727 17.625H15.2727C15.2727 19.4925 16.7345 21 18.5455 21C20.3564 21 21.8182 19.4925 21.8182 17.625H22.9091C23.5091 17.625 24 17.1187 24 16.5V12.7537C24 12.27 23.8473 11.7975 23.5636 11.4038L21.0545 7.95C20.8473 7.66875 20.52 7.5 20.1818 7.5ZM5.45455 18.75C4.85455 18.75 4.36364 18.2437 4.36364 17.625C4.36364 17.0063 4.85455 16.5 5.45455 16.5C6.05455 16.5 6.54545 17.0063 6.54545 17.625C6.54545 18.2437 6.05455 18.75 5.45455 18.75ZM20.1818 9.1875L22.32 12H17.4545V9.1875H20.1818ZM18.5455 18.75C17.9455 18.75 17.4545 18.2437 17.4545 17.625C17.4545 17.0063 17.9455 16.5 18.5455 16.5C19.1455 16.5 19.6364 17.0063 19.6364 17.625C19.6364 18.2437 19.1455 18.75 18.5455 18.75Z"
                                fill="#ffffff"></path>
                        </svg>
                        <p>{{ $product['stock']['promotion_label'] }}</p>
                    </div>
                @endif
            </div>
            <div class = "product__middle__name js-product-name" data-name = "{{ $product['slug'] }}">
                <h1>{{ $product['name'] }}</h1>
            </div>
        </div>

        <div class = "product__bottom">
            <div class = "product__bottom__sale-price">
                @if ($product['stock']['promotion_active'] == '1')
                    <p>{{ $product['stock']['price'] }}</p>
                @endif
            </div>
            <div class = "product__bottom__current-price">
                @if ($product['stock']['promotion_active'] == '1')
                    <h1>{{ $product['stock']['promotion_price'] }}</h1>
                @else
                    <h1>{{ number_format($product['stock']['price'], 2, ',', '.') }}</h1>
                @endif
                <div class = "product__bottom__current-price__discount"
                    style="{{ $product['stock']['promotion_active'] == '0' ? 'display: none;' : '' }}">
                    <p>- {{ $product['stock']['promotion_percentage'] }}%</p>
                </div>
            </div>
            <div class = "product__bottom__payment-methods">
                <p>{!! $product['stock']['payment_methods'] !!}</p>
            </div>
        </div>

        <div class = "product__buy">
            <div class = "product__buy__button js-buy-button"> <svg width="20" height="20"
                    viewBox="0 0 23 22" fill="none" xmlns="https://www.w3.org/2000/svg" class="IconCart">
                    <path
                        d="M7.09977 17.6C5.88981 17.6 4.91085 18.59 4.91085 19.8C4.91085 21.01 5.88981 22 7.09977 22C8.30973 22 9.2997 21.01 9.2997 19.8C9.2997 18.59 8.30973 17.6 7.09977 17.6ZM0.5 0V2.2H2.69992L6.65979 10.549L5.17484 13.244C4.99885 13.552 4.89985 13.915 4.89985 14.3C4.89985 15.51 5.88981 16.5 7.09977 16.5H20.2993V14.3H7.56176C7.40776 14.3 7.28677 14.179 7.28677 14.025L7.31977 13.893L8.30973 12.1H16.5044C17.3294 12.1 18.0554 11.649 18.4294 10.967L22.3672 3.828C22.458 3.66013 22.5037 3.47158 22.4998 3.28078C22.4959 3.08998 22.4426 2.90346 22.345 2.73943C22.2475 2.5754 22.1091 2.43947 21.9433 2.34492C21.7776 2.25037 21.5901 2.20044 21.3993 2.2H5.13084L4.09688 0H0.5ZM18.0994 17.6C16.8894 17.6 15.9105 18.59 15.9105 19.8C15.9105 21.01 16.8894 22 18.0994 22C19.3094 22 20.2993 21.01 20.2993 19.8C20.2993 18.59 19.3094 17.6 18.0994 17.6Z"
                        fill="#fff"></path>
                </svg>
                <p>COMPRAR</p>
            </div>
        </div>

    </a>
@endforeach
