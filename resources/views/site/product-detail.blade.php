@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/home.js')) }}"></script>
@endsection

@section('css')
    <!-- CSS -->
@endsection

@section('content')
    <section class="details-wrapper">
        <div class="details">
            <div class="details__caption">
                <h1>Você está em:</h1>
                <p>Hardware</p>
                <span>></span>
                <p>Placa de vídeo</p>
                <span>></span>
                <p>Outro</p>
                <span>></span>
                <h2>Código: 688564</h2>
            </div>
            <h1>{{ $product['product_name'] }}</h1>
            <div class = "details__item">
                <div class = "details__item__left">
                    <div class = "details__item__left__top">
                        <div class = "details__item__left__top__logo">
                            <img src="{{ $product['brand_logo'] }}" alt="">
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
                                    @foreach ($product['product_pictures'] as $picture)
                                        <div class = "details__item__left__middle__left__carousel__drag__item">
                                            <img src="{{ $picture }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class = "details__item__left__middle__left__up-arrow products_pics-embla-next">
                                <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                    xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                        fill="#565C69"></path>
                                </svg>
                            </div>
                            <div class = "details__item__left__middle__left__down-arrow products_pics-embla-prev">
                                <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                    xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                                        fill="#565C69"></path>
                                </svg>
                            </div>

                        </div>
                        <div class = "details__item__left__middle__right">
                            <img src="{{ $product['product_pictures'][0] }}" alt="">
                            <div class = "details__item__left__middle__right__sale-tag">
                                <p>mega maio</p>
                            </div>
                        </div>
                    </div>
                    <div class = "details__item__left__bottom">
                        <div class = "details__item__left__bottom__title">
                            <h1></h1>
                        </div>
                        <div class = "details__item__left__bottom__address">
                            <input type="text">
                            <a href=""></a>
                            <p></p>
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
                            <p></p>
                        </div>

                    </div>
                </div>
                <div class = "details__item__right">
                    <div class = "details__item__right__sale-banner">
                        <img src="" alt="">
                        <div class = "details__item__right__sale-banner__left">
                            <span></span>
                            <p>Desconto:
                            </p>
                            <p>20%
                            </p>
                        </div>
                        <div class = "details__item__right__sale-banner__right">
                            <span></span>
                            <p>Em estoque</p>
                        </div>
                    </div>
                    <div class = "details__item__right__actions">
                        <div class = "details__item__right__actions__caption">
                            <p>Vendido e entregue por: <strong>KaBuM!</strong> | <span>Em estoque</span></p>
                            <a href="">Ver mais ofertas</a>
                        </div>

                        <div class = "details__item__right__actions__texts">
                            <div class = "details__item__right__actions__texts__left">
                                <p></p>
                                <h1></h1>
                                <p></p>
                                <p></p>
                                <p></p>
                                <a href="">Ver mais opções de pagamento</a>
                            </div>

                            <div class = "details__item__right__actions__texts__right">
                                <a class = "details__item__right__actions__texts__right__buy">
                                    <h1>comprar</h1>
                                </a>
                                <a class = "details__item__right__actions__texts__right__cart"></a>
                            </div>


                        </div>


                    </div>
                    <div class = "details__item__right__related-products">
                        <div class = "details__item__right__related-products__caption">
                            <p>produtos relacionados</p>
                        </div>
                        <div class = "details__item__right__related-products__carousel related_pics-embla">
                            <div class = "details__item__right__related-products__carousel__drag ">
                                @foreach ($product['related_pictures'] as $rp)
                                    <div class = "details__item__right__related-products__carousel__drag__item">
                                        <img src="{{ $rp['path'] }}" alt="">
                                        <h1>{{ $rp['price'] }}</h1>
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
                </div>

            </div>
            <div class = "details__desc">
                <div class = "details__desc__item">
                    <div class = "details__desc__item__up">
                        <h1>descrição do produto</h1>
                    </div>
                    <div class = "details__desc__item__down">
                        <div class = "details__desc__item__down__title">
                            <h1></h1>
                        </div>
                        <div class = "details__desc__item__down__desc">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class = "details__desc__item">
                    <div class = "details__desc__item__up">
                        <h1>informações técnicas</h1>
                    </div>
                    <div class = "details__desc__item__down">
                        <div class = "details__desc__item__down__title">
                            <h1></h1>
                        </div>
                        <div class = "details__desc__item__down__desc">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
