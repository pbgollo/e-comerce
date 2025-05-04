<?php

namespace App\Http\Controllers\Site;

use App\Models\TranslateModel;

class ProductDetailController extends Controller
{
    public $vm = [];


    public function index()
    {
        $this->vm['product'] =
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
                'product_pictures' => [
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
                'discount_label' => 'Frete Grátis',
                'product_name' => 'Monitor Gamer LG UltraGear 27" FHD, IPS, 180Hz, 1ms GTG, HDR10, DisplayPort e HDMI, G-Sync, FreeSync, Preto -
            27GS60F-B',
            'brand_logo' => 'assets/site/images/logo_lg.jpg',
                'on_sale' => '0',
                'original_price' => '1.627,00',
                'sale_price' => '999,99',
                'sale_percentage' => '-31%',
                'payment_methods' => 'À vista no PIX<br>ou até <strong>10x de 111,10</strong>',
                'sale_countdown' => [
                    'boolean' => '0',
                    'timestamp' => '5 dias',
                ],
            ];


        return view("site.product-detail", $this->vm);
    }
}
