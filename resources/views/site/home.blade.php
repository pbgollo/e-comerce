@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/home.js')) }}"></script>
@endsection

@section('css')
    <!-- CSS -->
@endsection

@section('content')
    <div class = "data">
        @php
            $products = [
                [
                    'promotion_label' => 'MEGA MAIO',
                    'review_amount' => '500',
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
                    'card_image' => 'assets/site/images/web_product_1.webp',
                    'discount_label' => 'Frete Grátis',
                    'product_name' => 'Monitor Gamer LG UltraGear 27" FHD, IPS, 180Hz, 1ms GTG, HDR10, DisplayPort e HDMI, G-Sync, FreeSync, Preto -
        27GS60F-B',
                    'on_sale' => '0',
                    'original_price' => '1.627,00',
                    'sale_price' => '999,99',
                    'sale_percentage' => '-31%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 111,10</strong>',
                    'sale_countdown' => [
                        'boolean' => '0',
                        'timestamp' => '5 dias',
                    ],
                ],
                [
                    'promotion_label' => 'DESCONTO RELÂMPAGO',
                    'review_amount' => '312',
                    'review_stars_average' => '4.5',
                    'reviews' => [
                        [
                            'id' => '1',
                            'author' => 'ana',
                            'rating' => '5',
                            'date' => '25/04/2025',
                            'title' => 'Qualidade incrível!',
                            'comment' => 'Muito leve, silencioso e rápido.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_2.webp',
                    'discount_label' => '10% no PIX',
                    'product_name' => 'Notebook Lenovo Ideapad 3i Intel Core i5 8GB 256GB SSD Windows 11 15.6” FHD',
                    'on_sale' => '1',
                    'original_price' => '3.299,00',
                    'sale_price' => '2.799,00',
                    'sale_percentage' => '-15%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>12x de 233,25</strong>',
                    'sale_countdown' => [
                        'boolean' => '1',
                        'timestamp' => '2 dias',
                    ],
                ],
                [
                    'promotion_label' => 'SUPER TECH',
                    'review_amount' => '189',
                    'review_stars_average' => '3.8',
                    'reviews' => [
                        [
                            'id' => '2',
                            'author' => 'carlos',
                            'rating' => '4',
                            'date' => '28/04/2025',
                            'title' => 'Bom custo-benefício',
                            'comment' => 'Atende bem pro dia a dia.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_3.webp',
                    'discount_label' => 'Oferta Exclusiva',
                    'product_name' => 'Smartphone Samsung Galaxy M14 5G 128GB Azul 6GB RAM Câm. Tripla 50MP',
                    'on_sale' => '0',
                    'original_price' => '1.499,00',
                    'sale_price' => '1.099,00',
                    'sale_percentage' => '-26%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 109,90</strong>',
                    'sale_countdown' => [
                        'boolean' => '0',
                        'timestamp' => '',
                    ],
                ],
                [
                    'promotion_label' => 'MEGA MAIO',
                    'review_amount' => '89',
                    'review_stars_average' => '4.2',
                    'reviews' => [
                        [
                            'id' => '3',
                            'author' => 'lucas',
                            'rating' => '4',
                            'date' => '29/04/2025',
                            'title' => 'Recomendo',
                            'comment' => 'Som potente e bateria ótima.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_4.webp',
                    'discount_label' => 'Envio Expresso',
                    'product_name' => 'Fone de Ouvido Bluetooth JBL Tune 510BT Preto',
                    'on_sale' => '1',
                    'original_price' => '299,00',
                    'sale_price' => '199,90',
                    'sale_percentage' => '-33%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>6x de 33,32</strong>',
                    'sale_countdown' => [
                        'boolean' => '1',
                        'timestamp' => '12h restantes',
                    ],
                ],
                [
                    'promotion_label' => 'OFERTA DA SEMANA',
                    'review_amount' => '45',
                    'review_stars_average' => '4.7',
                    'reviews' => [
                        [
                            'id' => '4',
                            'author' => 'mariana',
                            'rating' => '5',
                            'date' => '27/04/2025',
                            'title' => 'Muito útil',
                            'comment' => 'Facilitou demais meu trabalho!',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_5.webp',
                    'discount_label' => 'Desconto Exclusivo',
                    'product_name' => 'Echo Dot 5ª geração com Relógio - Smart Speaker com Alexa',
                    'on_sale' => '1',
                    'original_price' => '449,00',
                    'sale_price' => '349,00',
                    'sale_percentage' => '-22%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 34,90</strong>',
                    'sale_countdown' => [
                        'boolean' => '0',
                        'timestamp' => '',
                    ],
                ],
                [
                    'promotion_label' => 'MEGA MAIO',
                    'review_amount' => '231',
                    'review_stars_average' => '4.4',
                    'reviews' => [
                        [
                            'id' => '5',
                            'author' => 'joão',
                            'rating' => '4',
                            'date' => '20/04/2025',
                            'title' => 'Imagem top!',
                            'comment' => 'Ideal pra jogos e filmes.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_6.webp',
                    'discount_label' => '10% OFF',
                    'product_name' => 'Smart TV 50” 4K UHD LG ThinQ AI, Alexa, webOS 23, HDR10, Wi-Fi, HDMI e USB',
                    'on_sale' => '1',
                    'original_price' => '2.899,00',
                    'sale_price' => '2.599,00',
                    'sale_percentage' => '-10%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>12x de 216,58</strong>',
                    'sale_countdown' => [
                        'boolean' => '1',
                        'timestamp' => '3 dias',
                    ],
                ],
                [
                    'promotion_label' => 'QUINTA TECH',
                    'review_amount' => '122',
                    'review_stars_average' => '4.0',
                    'reviews' => [
                        [
                            'id' => '6',
                            'author' => 'sara',
                            'rating' => '4',
                            'date' => '22/04/2025',
                            'title' => 'Compacto e veloz',
                            'comment' => 'Bom pra quem precisa de armazenamento rápido.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_7.webp',
                    'discount_label' => 'Oferta do Dia',
                    'product_name' => 'SSD Kingston NV2 1TB NVMe M.2 2280 PCIe 4.0',
                    'on_sale' => '1',
                    'original_price' => '499,00',
                    'sale_price' => '369,90',
                    'sale_percentage' => '-26%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>6x de 61,65</strong>',
                    'sale_countdown' => [
                        'boolean' => '1',
                        'timestamp' => '1 dia',
                    ],
                ],
                [
                    'promotion_label' => 'SUPER DESCONTO',
                    'review_amount' => '340',
                    'review_stars_average' => '4.5',
                    'reviews' => [
                        [
                            'id' => '1',
                            'author' => 'maria',
                            'rating' => '5',
                            'date' => '28/04/2025',
                            'title' => 'Muito bom',
                            'comment' => 'Ótima qualidade de imagem e entrega rápida.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_2.webp',
                    'discount_label' => 'Desconto Exclusivo',
                    'product_name' => 'Monitor Samsung 24" Full HD, IPS, 75Hz, HDMI e VGA, Preto - LF24T350FHLXZD',
                    'on_sale' => '1',
                    'original_price' => '899,00',
                    'sale_price' => '749,90',
                    'sale_percentage' => '-17%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 74,99</strong>',
                    'sale_countdown' => [
                        'boolean' => '0',
                        'timestamp' => '2 dias',
                    ],
                ],
                [
                    'promotion_label' => 'OFERTA RELÂMPAGO',
                    'review_amount' => '128',
                    'review_stars_average' => '3.8',
                    'reviews' => [
                        [
                            'id' => '2',
                            'author' => 'carlos',
                            'rating' => '4',
                            'date' => '25/04/2025',
                            'title' => 'Bom custo-benefício',
                            'comment' =>
                                'Funciona bem para o dia a dia. Nada extraordinário, mas entrega o que promete.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_3.webp',
                    'discount_label' => 'Frete Grátis',
                    'product_name' => 'Monitor Acer 21.5" Full HD, HDMI e VGA, 60Hz, Preto - SA220Q',
                    'on_sale' => '1',
                    'original_price' => '699,00',
                    'sale_price' => '599,90',
                    'sale_percentage' => '-14%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 59,99</strong>',
                    'sale_countdown' => [
                        'boolean' => '1',
                        'timestamp' => '12 horas',
                    ],
                ],
                [
                    'promotion_label' => 'DIA DAS MÃES',
                    'review_amount' => '210',
                    'review_stars_average' => '4.7',
                    'reviews' => [
                        [
                            'id' => '3',
                            'author' => 'aline',
                            'rating' => '5',
                            'date' => '29/04/2025',
                            'title' => 'Excelente qualidade',
                            'comment' => 'Muito elegante e cores vivas. Ótimo para home office.',
                        ],
                    ],
                    'card_image' => 'assets/site/images/web_product_4.webp',
                    'discount_label' => '10% OFF no PIX',
                    'product_name' => 'Monitor Dell 23.8" Full HD, IPS, HDMI, VGA, Ajuste de altura - SE2422HX',
                    'on_sale' => '1',
                    'original_price' => '1.199,00',
                    'sale_price' => '999,00',
                    'sale_percentage' => '-17%',
                    'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 99,90</strong>',
                    'sale_countdown' => [
                        'boolean' => '0',
                        'timestamp' => '3 dias',
                    ],
                ],
            ];
        @endphp
    </div>
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
