@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/home.js')) }}"></script>
@endsection

@section('css')
    <!-- CSS -->
@endsection

{{-- @dd($products) --}}

@section('content')
    @php
        foreach ($products as &$product) {
            $product = array_merge([
                'promotion_label' => 'MEGA MAIO',
                'review_amount' => '254',
                'review_stars_average' => '4',
                'reviews' => [
                    [
                        'id' => '0',
                        'author' => 'jhon',
                        'rating' => '4',
                        'date' => '30/04/2025',
                        'title' => 'perfeito',
                        'comment' => 'Excelentes cores, brilho e imagem...',
                    ],
                ],
                'discount_label' => 'Frete Grátis',
                'on_sale' => '0',
                'original_price' => '1.627,00',
                'sale_price' => '999,99',
                'sale_percentage' => '-31%',
                'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 111,10</strong>',
                'sale_countdown' => [
                    'boolean' => '0',
                    'timestamp' => '5 dias',
                ],
                'product_pictures' => [
                    'assets/site/images/product_image_1.webp',
                    'assets/site/images/product_image_2.webp',
                    'assets/site/images/product_image_3.webp',
                    'assets/site/images/product_image_4.webp',
                    'assets/site/images/product_image_5.webp',
                    'assets/site/images/product_image_6.jpg',
                    'assets/site/images/product_image_1.webp',
                    'assets/site/images/product_image_2.webp',
                    'assets/site/images/product_image_3.webp',
                    'assets/site/images/product_image_4.webp',
                    'assets/site/images/product_image_5.webp',
                    'assets/site/images/product_image_6.jpg',

                ],
                'related_pictures' => [
                    [
                        'path' => 'assets/site/images/other_products_1.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_2.jpg',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_3.jpg',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_4.jpg',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_5.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_6.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_7.jpg',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_8.jpg',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_9.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_10.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_11.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_12.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                    [
                        'path' => 'assets/site/images/other_products_13.webp',
                        'price' => 'R$ 3.999,00'
                    ],
                ],
                'brand_logo' => 'assets/site/images/logo_lg.jpg',
            ], $product);
        }
    @endphp

    <section id="home" class="home">
        <div class = "home__topcarousel">
            @include ('site.components.homebanner')
        </div>

        <div class = "home__listing">
            <div class = "home__listing__label">
                <h1>Mega maio</h1>
                <div class = "home__listing__label__counter">
                    <p>Termina em:</p>
                    <svg width="22" height="24" viewBox="0 0 22 24" fill="#FFFFFF" xmlns="https://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.30852 1.94579H13.8024C13.9049 1.94579 13.9888 1.8663 13.9888 1.76913V0.176913C13.9888 0.0797498 13.9049 0 13.8024 0H8.30852C8.20597 0 8.12207 0.0797498 8.12207 0.176913V1.76913C8.12207 1.8663 8.20597 1.94579 8.30852 1.94579ZM0 13.5768C0 19.3238 4.93453 23.9993 11 23.9993C17.0655 23.9993 22 19.3238 22 13.5768C22 7.83001 17.0655 3.1543 11 3.1543C4.93453 3.1543 0 7.83001 0 13.5768ZM2.3466 13.5768C2.3466 9.05604 6.22849 5.37795 11 5.37795C15.7715 5.37795 19.6534 9.05604 19.6534 13.5768C19.6534 18.0978 15.7715 21.7759 11 21.7759C6.22849 21.7759 2.3466 18.0978 2.3466 13.5768ZM9.99573 13.571C9.86644 13.7848 9.83157 14.0197 9.87842 14.2352C9.93502 14.4956 10.1113 14.7275 10.3854 14.8579C10.8865 15.0964 11.5243 14.9064 11.8103 14.434L14.1204 10.6152C14.4061 10.1428 14.2318 9.56692 13.7305 9.3283C13.2297 9.09004 12.5919 9.27995 12.3062 9.7523L9.99573 13.571ZM20.5757 6.16097L18.5687 4.49657C18.5136 4.45089 18.508 4.37064 18.5562 4.3184L19.3468 3.46285C19.395 3.41061 19.4797 3.40531 19.5348 3.45099L21.5418 5.11514C21.597 5.16107 21.6026 5.24107 21.5543 5.29331L20.7638 6.14911C20.7153 6.20135 20.6309 6.20665 20.5757 6.16097Z"
                            fill="#FFFFFF" height="24" aria-hidden="true"></path>
                    </svg>
                    <h1>31d 16 : 57 : 18</h1>
                </div>
            </div>
            <div class = "home__listing__items">
                @include ('site.components.product', [$products])
            </div>
        </div>

    </section>
@endsection
