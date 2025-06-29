@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/home.js')) }}"></script>
@endsection

@section('css')
    <!-- CSS -->
@endsection

{{-- @dd($product) --}}

@section('content')
    <section class="details-wrapper">
        <div class="details">
            <div class="details__caption">
                <h1>Você está em:</h1>
                <p>{{$product_cat['name']}}</p>
                <span>></span>
                <h2>{{$product['name']}}</h2>
            </div>
            <h1 class="name">{{ $product['name'] }}</h1>
            <div class = "details__item">
                <div class = "details__item__left">
                    <div class = "details__item__left__top">
                        <div class = "details__item__left__top__logo">
                            <img src="{{ resize($product['supplier']['image']) }}" alt="">
                        </div>
                        <div class = "details__item__left__top__rating">
                            <div class = "details__item__left__top__rating__stars">
                                @foreach (range(1, 5) as $i)
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        xmlns="https://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.434 23.7375C17.6965 23.8875 17.9965 24 18.334 24C18.8215 24 19.3465 23.775 19.6465 23.3625C19.9465 22.95 20.059 22.425 19.9465 21.9375L18.409 15.375C18.409 15.3 18.4465 15.225 18.484 15.1875L23.3965 10.7625C23.9215 10.3125 24.109 9.6 23.884 8.9625C23.659 8.325 23.0965 7.875 22.4215 7.8375L16.084 7.35C16.009 7.35 15.9715 7.3125 15.934 7.2375L13.5715 1.0875C13.309 0.4125 12.709 0 11.9965 0C11.284 0 10.684 0.4125 10.384 1.0875L8.02153 7.2375C7.98403 7.3125 7.94653 7.35 7.87153 7.35L1.53403 7.8375C0.859031 7.875 0.296531 8.325 0.0715307 8.9625C-0.115969 9.6 0.0715306 10.3125 0.559031 10.7625L5.47153 15.1875C5.54653 15.225 5.54653 15.3 5.54653 15.375L4.04653 21.9375C3.89653 22.425 4.00903 22.95 4.34653 23.3625C4.64653 23.775 5.13403 24 5.65903 24C5.99653 24 6.29653 23.8875 6.59653 23.7375L11.9215 20.25C11.9965 20.2125 12.034 20.2125 12.109 20.25L17.434 23.7375Z"
                                            fill="#FF6500"></path>
                                    </svg>
                                @endforeach
                                <div class = "details__item__left__top__rating__value">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class = "details__item__left__top__actions">
                            <a href="" class = "details__item__left__top__actions__item">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="https://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M20.25 16.5C21.2813 16.5 22.1641 16.8672 22.8984 17.6016C23.6328 18.3359 24 19.2187 24 20.25C24 21.2813 23.6328 22.1641 22.8984 22.8984C22.1641 23.6328 21.2813 24 20.25 24C19.2187 24 18.3359 23.6328 17.6016 22.8984C16.8672 22.1641 16.5 21.2813 16.5 20.25C16.5 20.0938 16.5078 19.9453 16.5234 19.8047C16.5391 19.6641 16.5703 19.5234 16.6172 19.3828L6.67969 14.3203C6.33594 14.7578 5.91016 15.1055 5.40234 15.3633C4.89453 15.6211 4.34375 15.75 3.75 15.75C2.71874 15.75 1.83594 15.3828 1.10156 14.6484C0.367184 13.9141 0 13.0313 0 12C0 10.9687 0.367184 10.0859 1.10156 9.35156C1.83594 8.61718 2.71874 8.25 3.75 8.25C4.29688 8.25 4.80859 8.35937 5.28516 8.57812C5.76172 8.79688 6.17187 9.10156 6.51562 9.49219L16.5938 4.59375C16.5625 4.45312 16.5391 4.3125 16.5234 4.17188C16.5078 4.03125 16.5 3.89063 16.5 3.75C16.5 2.71874 16.8672 1.83594 17.6016 1.10156C18.3359 0.367184 19.2187 0 20.25 0C21.2813 0 22.1641 0.367184 22.8984 1.10156C23.6328 1.83594 24 2.71874 24 3.75C24 4.78126 23.6328 5.66406 22.8984 6.39844C22.1641 7.13282 21.2813 7.5 20.25 7.5C19.625 7.5 19.0508 7.35938 18.5273 7.07812C18.0039 6.79687 17.5703 6.42188 17.2266 5.95312L7.28906 10.7812C7.35156 10.9688 7.40234 11.1641 7.44141 11.3672C7.48047 11.5703 7.5 11.7812 7.5 12C7.5 12.1719 7.48828 12.3398 7.46484 12.5039C7.44141 12.668 7.40625 12.8281 7.35938 12.9844L17.25 18.0234C17.5781 17.5547 18.0039 17.1836 18.5273 16.9102C19.0508 16.6367 19.625 16.5 20.25 16.5ZM20.25 1.5C19.625 1.5 19.0938 1.71875 18.6562 2.15625C18.2187 2.59375 18 3.125 18 3.75C18 4.375 18.2187 4.90625 18.6562 5.34375C19.0938 5.78125 19.625 6 20.25 6C20.875 6 21.4062 5.78125 21.8438 5.34375C22.2813 4.90625 22.5 4.375 22.5 3.75C22.5 3.125 22.2813 2.59375 21.8438 2.15625C21.4062 1.71875 20.875 1.5 20.25 1.5ZM3.75 14.25C4.375 14.25 4.90625 14.0313 5.34375 13.5938C5.78125 13.1562 6 12.625 6 12C6 11.375 5.78125 10.8438 5.34375 10.4062C4.90625 9.96875 4.375 9.75 3.75 9.75C3.125 9.75 2.59375 9.96875 2.15625 10.4062C1.71875 10.8438 1.5 11.375 1.5 12C1.5 12.625 1.71875 13.1562 2.15625 13.5938C2.59375 14.0313 3.125 14.25 3.75 14.25ZM20.25 22.5C20.875 22.5 21.4062 22.2813 21.8438 21.8438C22.2813 21.4062 22.5 20.875 22.5 20.25C22.5 19.625 22.2813 19.0938 21.8438 18.6562C21.4062 18.2187 20.875 18 20.25 18C19.625 18 19.0938 18.2187 18.6562 18.6562C18.2187 19.0938 18 19.625 18 20.25C18 20.875 18.2187 21.4062 18.6562 21.8438C19.0938 22.2813 19.625 22.5 20.25 22.5Z"
                                        fill="#7F858D"></path>
                                </svg>
                            </a>
                            <a href="" class = "details__item__left__top__actions__item">
                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                    xmlns="https://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 21.6L11.5875 21.3C11.1 20.9625 0 13.275 0 6.975V6.5625C0 2.9625 2.9625 0 6.6 0C8.8125 0 10.8 1.0875 12 2.85C13.2 1.0875 15.225 0 17.4 0C21.0375 0 24 2.925 24 6.5625V6.975C24 13.2375 12.9 20.9625 12.4125 21.3L12 21.6ZM6.6 1.5C3.7875 1.5 1.5 3.7875 1.5 6.5625V6.975C1.5 9.225 3.375 12.15 6.8625 15.525C9 17.5125 11.1 19.125 12 19.7625C12.9 19.125 15 17.5125 17.1375 15.525C20.625 12.15 22.5 9.225 22.5 6.975V6.5625C22.5 3.7875 20.2125 1.5 17.4 1.5C15.3 1.5 13.4625 2.7375 12.675 4.6875L12 6.45L11.2875 4.725C10.5375 2.775 8.6625 1.5 6.6 1.5Z"
                                        fill="#7F858D"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class = "details__item__left__middle">

                        <div class = "details__item__left__middle__left">
                            <div class = "details__item__left__middle__left__carousel products_pics-embla">
                                <div class = "details__item__left__middle__left__carousel__drag">
                                    @foreach ($product['images'] as $index => $picture)
                                        <div class = "details__item__left__middle__left__carousel__drag__item">
                                            <img src="{{ resize($picture['image']) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class = "details__item__left__middle__right">
                            <img src="{{ resize($product['image']) }}" alt="">
                            <div class = "details__item__left__middle__right__sale-tag">
                                <p>mega maio</p>
                            </div>
                        </div>

                        <div class = "products_pics-embla-next">
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                    fill="#565C69"></path>
                            </svg>
                        </div>
                        <div class = "products_pics-embla-prev">
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                    fill="#565C69"></path>
                            </svg>
                        </div>

                    </div>
                    <div class = "details__item__left__bottom">
                        <div class = "details__item__left__bottom__title">
                            <h1>Consultar Frete e prazo de entrega</h1>
                        </div>
                        <div class = "details__item__left__bottom__address">
                            <input type="text">
                            <a href="javascript:void(0)">OK</a>
                            <a>Não lembro meu cep</a>
                        </div>
                        <div class = "details__item__left__bottom__warning">
                            <span>
                                <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg"
                                    height="16" class="flex-shrink-0">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM11.9183 19.3859C10.8643 19.3859 10.0283 18.5943 10.0283 17.6134C10.0283 16.6326 10.8643 15.841 11.9183 15.841C12.9722 15.841 13.8082 16.6326 13.8082 17.6134C13.8082 18.5943 12.9722 19.3859 11.9183 19.3859ZM10.5464 12.7859C10.6133 13.4935 11.2074 14.0342 11.9183 14.0342C12.6291 14.0342 13.2233 13.4935 13.2902 12.7859L13.8278 7.09862C13.9342 5.97299 13.0489 5 11.9183 5C10.7876 5 9.90227 5.97299 10.0087 7.09862L10.5464 12.7859Z"
                                        fill="#FF6500"></path>
                                </svg>
                            </span>
                            <p>Os prazos de entrega começam a contar a partir da confirmação de pagamento
                            </p>
                        </div>

                    </div>
                </div>
                <div class = "details__item__right">
                    <div class = "details__item__right__sale-banner">
                        {{-- <img src="" alt=""> --}}
                        <div class = "details__item__right__sale-banner__left">
                            <span>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="https://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.7559 0.93144L11.3455 3.33976C11.1508 3.53448 10.887 3.64416 10.6117 3.6448H6.81893C5.06548 3.6448 3.6448 5.06548 3.6448 6.81893V10.6117C3.6448 10.889 3.53388 11.1514 3.33976 11.3476L0.929307 13.7559C0.334271 14.3512 0 15.1584 0 16C0 16.8416 0.334271 17.6488 0.929307 18.2441L3.33976 20.6545C3.53448 20.8492 3.64416 21.113 3.6448 21.3883V25.1811C3.6448 26.9345 5.06548 28.3552 6.81893 28.3552H10.6117C10.889 28.3552 11.1514 28.4661 11.3476 28.6602L13.7559 31.0707C14.3512 31.6657 15.1584 32 16 32C16.8416 32 17.6488 31.6657 18.2441 31.0707L20.6545 28.6602C20.8492 28.4655 21.113 28.3558 21.3883 28.3552H25.1811C26.9345 28.3552 28.3552 26.9345 28.3552 25.1811V21.3883C28.3552 21.111 28.4661 20.8486 28.6602 20.6524L31.0707 18.2441C31.6657 17.6488 32 16.8416 32 16C32 15.1584 31.6657 14.3512 31.0707 13.7559L28.6602 11.3455C28.4655 11.1508 28.3558 10.887 28.3552 10.6117V6.81893C28.3552 5.06548 26.9345 3.6448 25.1811 3.6448H21.3883C21.1123 3.64473 20.8476 3.535 20.6524 3.33976L18.2441 0.929307C17.6488 0.334271 16.8416 0 16 0C15.1584 0 14.3512 0.334271 13.7559 0.929307V0.93144ZM9.91199 20.5777L20.5777 9.91199L22.088 11.4223L11.4223 22.088L9.91199 20.5777ZM10.6671 10.6671V12.8003H12.8003V10.6671H10.6671ZM19.1997 21.3329H21.3329V19.1997H19.1997V21.3329Z"
                                        fill="#fff"></path>
                                </svg>
                            </span>
                            <p>Desconto:
                            </p>
                            <p><strong>20%</strong>
                            </p>
                        </div>
                        <div class = "details__item__right__sale-banner__right">
                            <span>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="https://www.w3.org/2000/svg">
                                    <path
                                        d="M31.1111 17.4211H26.6667V22.9474L24.8889 21.7212L23.1111 22.9474V17.4211H18.6667C18.1778 17.4211 17.7778 17.8355 17.7778 18.3421V31.0789C17.7778 31.5855 18.1778 32 18.6667 32H31.1111C31.6 32 32 31.5855 32 31.0789V18.3421C32 17.8355 31.6 17.4211 31.1111 17.4211ZM9.77778 14.5789H22.2222C22.7111 14.5789 23.1111 14.1645 23.1111 13.6579V0.921053C23.1111 0.414474 22.7111 0 22.2222 0H17.7778V5.52632L16 4.30016L14.2222 5.52632V0H9.77778C9.28889 0 8.88889 0.414474 8.88889 0.921053V13.6579C8.88889 14.1645 9.28889 14.5789 9.77778 14.5789ZM13.3333 17.4211H8.88889V22.9474L7.11111 21.7212L5.33333 22.9474V17.4211H0.888889C0.4 17.4211 0 17.8355 0 18.3421V31.0789C0 31.5855 0.4 32 0.888889 32H13.3333C13.8222 32 14.2222 31.5855 14.2222 31.0789V18.3421C14.2222 17.8355 13.8222 17.4211 13.3333 17.4211Z"
                                        fill="#fff"></path>
                                </svg>
                            </span>

                            @if ($product['stock']['quantity'] > 0)
                                <p>Em estoque</p>
                            @else
                                <p>Esgotado</p>
                            @endif
                        </div>
                    </div>
                    <div class = "details__item__right__actions">
                        <div class = "details__item__right__actions__caption">
                            <p>
                                Vendido e entregue por: <strong>{{ $product['supplier']['name'] }}</strong> |
                                @if ($product['stock']['quantity'] > 0)
                                    <span>Em estoque</span>
                                @else
                                    <span style="color: red;">Esgotado</span>
                                @endif
                            </p>

                            <a href="">Ver mais ofertas</a>
                        </div>

                        <div class = "details__item__right__actions__texts">
                            <div class = "details__item__right__actions__texts__left">
                                @if ($product['stock']['promotion_active'] == '1')
                                    <p class="sale">{{ $product['stock']['price'] }}</p>
                                    <h1>{{ $product['stock']['promotion_price'] }}</h1>
                                    <p>{!! $product['stock']['payment_methods'] !!}</p>
                                @else
                                    <h1>{{ number_format($product['stock']['price'], 2, ',', '.') }}</h1>
                                    <p>{!! $product['stock']['payment_methods'] !!}</p>
                                @endif
                            </div>

                            <div class = "details__item__right__actions__texts__right">
                                <a href = "{{'product/'.$product['slug'].'/cart'}}" class = "details__item__right__actions__texts__right__buy">
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                                        xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M7.09977 17.6C5.88981 17.6 4.91085 18.59 4.91085 19.8C4.91085 21.01 5.88981 22 7.09977 22C8.30973 22 9.2997 21.01 9.2997 19.8C9.2997 18.59 8.30973 17.6 7.09977 17.6ZM0.5 0V2.2H2.69992L6.65979 10.549L5.17484 13.244C4.99885 13.552 4.89985 13.915 4.89985 14.3C4.89985 15.51 5.88981 16.5 7.09977 16.5H20.2993V14.3H7.56176C7.40776 14.3 7.28677 14.179 7.28677 14.025L7.31977 13.893L8.30973 12.1H16.5044C17.3294 12.1 18.0554 11.649 18.4294 10.967L22.3672 3.828C22.458 3.66013 22.5037 3.47158 22.4998 3.28078C22.4959 3.08998 22.4426 2.90346 22.345 2.73943C22.2475 2.5754 22.1091 2.43947 21.9433 2.34492C21.7776 2.25037 21.5901 2.20044 21.3993 2.2H5.13084L4.09688 0H0.5ZM18.0994 17.6C16.8894 17.6 15.9105 18.59 15.9105 19.8C15.9105 21.01 16.8894 22 18.0994 22C19.3094 22 20.2993 21.01 20.2993 19.8C20.2993 18.59 19.3094 17.6 18.0994 17.6Z"
                                            fill="#ffffffff"></path>
                                    </svg>
                                    <h1>comprar</h1>
                                </a>
                                <a class = "details__item__right__actions__texts__right__cart">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="https://www.w3.org/2000/svg" class="IconAddToCart">
                                        <path
                                            d="M17.5 18.78V17.04H6.2C6.06 17 5.96 16.89 5.96 16.75L5.99 16.63L6.87 14.43H14.85C15.56 14.43 16.18 14.03 16.5 13.43L17.38 11.8C14.53 11.12 12.35 8.71 12.03 5.73H4.12L3.2 4H0V5.74H1.94L5.44 13.36L4.13 15.82C3.9 16.23 3.82 16.75 3.95 17.28C4.17 18.19 5.03 18.79 5.94 18.79H17.5V18.78Z"
                                            fill="#42464D"></path>
                                        <path
                                            d="M16.18 20C15.1 20 14.23 20.9 14.23 22C14.23 23.1 15.1 24 16.18 24C17.26 24 18.14 23.1 18.14 22C18.13 20.9 17.25 20 16.18 20Z"
                                            fill="#42464D"></path>
                                        <path
                                            d="M6.40001 20C5.32001 20 4.45001 20.9 4.45001 22C4.45001 23.1 5.32001 24 6.40001 24C7.48001 24 8.36001 23.1 8.36001 22C8.35001 20.9 7.47001 20 6.40001 20Z"
                                            fill="#42464D"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19 0C16.238 0 14 2.23858 14 5C14 7.76203 16.2386 10 19 10C21.762 10 24 7.76142 24 5C24 2.23797 21.7614 0 19 0ZM18.4444 2.36249V4.44444H16.2236C15.9199 4.44444 15.6667 4.69318 15.6667 5C15.6667 5.30896 15.916 5.55556 16.2236 5.55556H18.4444V7.91529C18.4444 8.21902 18.6932 8.47222 19 8.47222C19.309 8.47222 19.5556 8.22288 19.5556 7.91529V5.55556H21.7764C22.0801 5.55556 22.3333 5.30682 22.3333 5C22.3333 4.69104 22.084 4.44444 21.7764 4.44444H19.5556V2.36249C19.5556 2.05876 19.3068 1.80556 19 1.80556C18.691 1.80556 18.4444 2.0549 18.4444 2.36249Z"
                                            fill="#42464D"></path>
                                    </svg>
                                </a>
                            </div>


                        </div>


                    </div>
                    @if (count($related_products) > 0)
                        <div class = "details__item__right__related-products">
                            <div class = "details__item__right__related-products__caption">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="https://www.w3.org/2000/svg" class="IconTag" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2 1C1.73478 1 1.48043 1.10536 1.29289 1.29289C1.10536 1.48043 1 1.73478 1 2V6.586C1.00006 6.8512 1.10545 7.10551 1.293 7.293L8.293 14.293C8.48053 14.4805 8.73484 14.5858 9 14.5858C9.26517 14.5858 9.51947 14.4805 9.707 14.293L14.293 9.707C14.4805 9.51947 14.5858 9.26517 14.5858 9C14.5858 8.73484 14.4805 8.48053 14.293 8.293L7.293 1.293C7.10551 1.10545 6.8512 1.00006 6.586 1H2ZM6 4.5C6 4.89783 5.84197 5.27936 5.56066 5.56066C5.27936 5.84197 4.89783 6 4.5 6C4.10218 6 3.72064 5.84197 3.43934 5.56066C3.15804 5.27936 3 4.89783 3 4.5C3 4.10218 3.15804 3.72064 3.43934 3.43934C3.72064 3.15804 4.10218 3 4.5 3C4.89783 3 5.27936 3.15804 5.56066 3.43934C5.84197 3.72064 6 4.10218 6 4.5Z"
                                        fill="#FF6500"></path>
                                </svg>
                                <p>produtos relacionados</p>
                            </div>
                            <div class = "details__item__right__related-products__carousel related_pics-embla">
                                <div class = "details__item__right__related-products__carousel__drag ">
                                    @foreach ($related_products as $rp)
                                        <div class = "details__item__right__related-products__carousel__drag__item">
                                            <img src="{{ resize($rp['image']) }}" alt="">
                                            <h1>{{ $rp['stock']['price'] }}</h1>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <span class = "related_pics-embla-prev">
                                <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                    xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                        fill="#565C69"></path>
                                </svg>
                            </span>
                            <span class = "related_pics-embla-next">
                                <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                    xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                        fill="#565C69"></path>
                                </svg>
                            </span>
                        </div>
                    @endif
                </div>

            </div>
            <div class = "details__desc">
                <div class = "details__desc__item">
                    <div class = "details__desc__item__up">

                        <h1><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="https://www.w3.org/2000/svg" class="IconDescription">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.59961 2.4C1.59961 1.76348 1.85247 1.15303 2.30255 0.702944C2.75264 0.252856 3.36309 0 3.99961 0L17.1308 0L22.3996 5.2688V21.6C22.3996 22.2365 22.1468 22.847 21.6967 23.2971C21.2466 23.7471 20.6361 24 19.9996 24H3.99961C3.36309 24 2.75264 23.7471 2.30255 23.2971C1.85247 22.847 1.59961 22.2365 1.59961 21.6V2.4ZM6.39961 6.3952H17.5996V7.9952H6.39961V6.3952ZM17.5996 11.192H6.39961V12.792H17.5996V11.192ZM17.5996 16H6.39961V17.6H17.5996V16Z"
                                    fill="#FF6500"></path>
                            </svg>descrição do produto</h1>
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                            xmlns="https://www.w3.org/2000/svg" class="arrow-icon" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.0459 1.54599L10.955 0.455078L6.0459 5.36417L1.13681 0.455078L0.0458984 1.54599L6.0459 7.54599L12.0459 1.54599Z"
                                fill="#ff6500" aria-hidden="true"></path>
                        </svg>
                    </div>
                    <div class = "details__desc__item__down off">
                        <div class = "details__desc__item__down__desc">
                            <p>{!! $product['description'] !!}</p>
                        </div>
                    </div>
                </div>
                <div class = "details__desc__item">
                    <div class = "details__desc__item__up">

                        <h1><svg width="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg"
                                class="IconAlert">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM11.9183 19.3859C10.8643 19.3859 10.0283 18.5943 10.0283 17.6134C10.0283 16.6326 10.8643 15.841 11.9183 15.841C12.9722 15.841 13.8082 16.6326 13.8082 17.6134C13.8082 18.5943 12.9722 19.3859 11.9183 19.3859ZM10.5464 12.7859C10.6133 13.4935 11.2074 14.0342 11.9183 14.0342C12.6291 14.0342 13.2233 13.4935 13.2902 12.7859L13.8278 7.09862C13.9342 5.97299 13.0489 5 11.9183 5C10.7876 5 9.90227 5.97299 10.0087 7.09862L10.5464 12.7859Z"
                                    fill="#FF6500"></path>
                            </svg>informações técnicas</h1>
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                            xmlns="https://www.w3.org/2000/svg" class="arrow-icon" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.0459 1.54599L10.955 0.455078L6.0459 5.36417L1.13681 0.455078L0.0458984 1.54599L6.0459 7.54599L12.0459 1.54599Z"
                                fill="#ff6500" aria-hidden="true"></path>
                        </svg>
                    </div>
                    <div class = "details__desc__item__down off">
                        <div class = "details__desc__item__down__desc">
                            <p>{!! $product['technical_details'] !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
