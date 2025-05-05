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
                'product_description' => '<strong>Domine a Arena com a Velocidade Implacável de 180Hz</strong>
Sinta a diferença que um verdadeiro monitor gamer pode fazer! O LG UltraGear 24" 24GS60F-B eleva sua experiência de jogo a um novo patamar com sua incrível taxa de atualização de 180Hz. Diga adeus ao lag e ao ghosting e prepare-se para uma jogabilidade ultra fluida e responsiva, onde cada milissegundo conta para a sua vitória!
<br>
<br>
<br>
<strong>Sincronia Perfeita para Jogabilidade Imersiva</strong>
Equipado com a tecnologia Adaptive Sync, o LG UltraGear 24GS60F-B é compatível com NVIDIA® G-SYNC® e AMD FreeSync™. Isso significa que a taxa de atualização do monitor se sincroniza dinamicamente com a taxa de quadros da sua placa de vídeo, eliminando rupturas e travamentos na tela. Desfrute de visuais incrivelmente suaves e mergulhe de cabeça em mundos virtuais sem distrações!
<br>
<br>
<br>
<strong>Cores Vivas e Detalhes Nítidos com Painel IPS Full HD</strong>
Prepare-se para ser envolvido por imagens de alta qualidade e cores vibrantes! O painel IPS Full HD do LG UltraGear oferece ângulos de visão amplos de até 178°, garantindo que você não perca nenhum detalhe da ação, não importa sua posição. Experimente a verdadeira emoção de cada jogo com visuais ricos e imersivos.',


                'product_technicals' => '<strong>Características:</strong><br>
- Marca: LG<br>
- Modelo: 24GS60F-B<br>
<br>
<br>
<strong>Tela:</strong><br>
- Tamanho: 24"<br>
- Proporção: 16:9<br>
- Tipo de painel: IPS<br>
- Tempo de resposta: 1ms (GtG)<br>
- Resolução: 1920x1080<br>
- Paso de píxeles [mm]: 0.2745 x 0.2745mm<br>
- Profundidade de cor (número de cores): 16.7M<br>
- Ângulo de visão (CR≥10): 178º(R/L), 178º(U/D)<br>
- Brilho (típ.) [cd/m²]: 300cd/m²<br>
- Relação de contraste (Tipo): 1000:1<br>
- Gama de cores (Typ.): sRGB 99%<br>
- Taxa de atualização (máx.) [Hz]: 180hz<br>
- Bit de cor: 8 bits<br>
- Tratamento de Superfície: Antirreflexo<br>
<br>
<br>
<strong>Conectividade:</strong><br>
- HDMI: Sim<br>
- DisplayPort: Sim<br>
- Versão DP: 1.4<br>
',
            ];


        return view("site.product-detail", $this->vm);
    }
}
