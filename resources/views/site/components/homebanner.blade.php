@php
    $offers_images = [
        ['path' => 'assets/site/images/offer_1.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_2.gif', 'link' => ''],
        ['path' => 'assets/site/images/offer_3.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_4.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_5.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_6.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_7.webp', 'link' => ''],
        ['path' => 'assets/site/images/offer_8.webp', 'link' => ''],
    ];
@endphp

<div class = "offers-banner home-embla">
    <div class = "offers-banner__slides">
        @foreach ($offers_images as $offer)
            <div class = "offers-banner__slides__item">
                <div class = "offers-banner__slides__item__image">
                    <a href="{{ $offer['link']!='' ? $offer['link'] : 'javascript:void(0);' }}">
                        <img src="{{ $offer['path'] }}" alt="">
                    </a>

                    <div class = "offers-banner__slides__item__image__arrow home-embla-prev">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                            xmlns="https://www.w3.org/2000/svg" class="IconCarouselPrev" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9998 24L19.1816 21.8182L9.36346 12L19.1816 2.18182L16.9998 0L4.99982 12L16.9998 24Z"
                                fill="#003A6A"></path>
                        </svg>
                    </div>
                    <div class = "offers-banner__slides__item__image__arrow home-embla-next">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                            xmlns="https://www.w3.org/2000/svg" class="IconCarouselPrev" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9998 24L19.1816 21.8182L9.36346 12L19.1816 2.18182L16.9998 0L4.99982 12L16.9998 24Z"
                                fill="#003A6A"></path>
                        </svg>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class = "offers-banner__slides__item__pagination home-embla-dots"></div>
</div>
