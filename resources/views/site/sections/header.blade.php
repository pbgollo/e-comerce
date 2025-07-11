<header class="header">
    @php
        $header_items = [
            [
                'title' => 'categorias',

                'link' => '',

                'subcat' => $categories,
            ],
            [
                'title' => 'monte seu pc',
            ],
            [
                'title' => 'cupons',
            ],
            [
                'title' => 'hardware',
            ],
            [
                'title' => 'pc gamer',
            ],
            [
                'title' => 'computadores',
            ],
            [
                'title' => 'periféricos',
            ],
            [
                'title' => 'escritório',
            ],
            [
                'title' => 'venda no kabum!',
            ],
        ];

    @endphp
    <div class = "header__top">
        <div class = "header__top__hamburger">
            <div class = "header__top__hamburger__button">
                <svg width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="https://www.w3.org/2000/svg"
                    class="IconSandwich" aria-hidden="true">
                    <path
                        d="M0.75 0.5H29.25V3.66667H0.75V0.5ZM0.75 8.41667H29.25V11.5833H0.75V8.41667ZM0.75 16.3333H29.25V19.5H0.75V16.3333Z"
                        fill="#ffffffff"></path>
                </svg>
            </div>
        </div>
        <div class = "header__top__logo">
            <a href="">
                <img src="assets/site/images/site_logo.svg" alt="">
            </a>
        </div>
        <div class = "header__top__searchbar">
            <form id="product-search-form" action="{{ route('product-search') }}">
                <input type="text" name="q" placeholder="Busque no KaBuM!">
                <button><svg width="64" height="47" viewBox="0 0 64 47" fill="none"
                        xmlns="https://www.w3.org/2000/svg" class="IconHeaderSearch" aria-hidden="true">
                        <g>
                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.44003 46.3732C2.33389 46.3732 0.0479286 44.8936 0.00727544 41.6467L0.00571271 41.6074C-0.111556 38.2222 1.57555 35.1922 5.16554 32.3479C8.48815 29.7142 12.7677 27.7283 16.5422 25.9752C17.5178 25.5223 18.7296 24.961 19.8007 24.4295L22.0991 23.2912L20.2307 21.5301C13.2102 14.9137 8.37401 9.8885 10.1143 5.46235C11.0196 3.16044 13.3259 1.99219 16.9722 1.99219C17.1332 1.99219 17.2989 1.99376 17.4678 1.99848L17.5491 2.00162C20.2901 2.12426 24.9042 4.129 30.1954 7.50011L31.834 8.54415L32.7206 6.80828C33.7025 4.88845 35.8274 3.91517 39.0343 3.91517C39.1969 3.91517 39.3674 3.91831 39.5409 3.92303C42.224 3.98907 46.4707 5.82085 51.5055 9.08189C55.7443 11.8272 59.647 15.0332 61.1668 16.6543C63.0807 18.6606 63.889 21.0506 63.4528 23.3965C62.4474 28.8022 55.6912 32.3589 48.8583 35.5382L48.7536 35.5869C48.3892 35.7567 48.0531 35.9124 47.7529 36.0555L47.7153 36.0728L47.6778 36.0932C39.2986 40.5838 33.2272 43.554 29.6309 44.9203C28.8742 45.2128 28.1471 45.359 27.4591 45.359C25.0606 45.359 23.3031 43.6169 23.0889 41.0225L23.0826 40.9423C23.0811 40.8857 23.0779 40.8008 23.0764 40.7945L22.8934 38.0964L20.4996 39.3275C15.4367 41.9329 10.2628 44.5351 6.7041 45.9235L6.6056 45.9612C5.83475 46.238 5.12645 46.3732 4.44003 46.3732Z"
                                fill="black"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.85214 45.008C2.746 45.008 0.46004 43.5284 0.419387 40.2815L0.417822 40.2422C0.300553 36.8569 1.98766 33.827 5.57764 30.9826C8.90025 28.349 13.1798 26.3631 16.9543 24.6099C17.9299 24.1571 19.1417 23.5958 20.2128 23.0643L22.5112 21.9259L20.6428 20.1649C13.6223 13.5485 8.78611 8.52327 10.5264 4.09712C11.4317 1.79521 13.738 0.626953 17.3842 0.626953C17.5453 0.626953 17.711 0.628527 17.8799 0.633244L17.9612 0.636389C20.7022 0.759032 25.3163 2.76377 30.6075 6.13488L32.2461 7.17892L33.1326 5.44305C34.1146 3.52321 36.2395 2.54993 39.4464 2.54993C39.609 2.54993 39.7794 2.55308 39.953 2.55779C42.6361 2.62383 46.8828 4.45562 51.9175 7.71666C56.1564 10.462 60.0591 13.668 61.5789 15.2891C63.4927 17.2954 64.3011 19.6853 63.8648 22.0313C62.8595 27.437 56.1032 30.9937 49.2704 34.1729L49.1656 34.2217C48.8013 34.3915 48.4651 34.5472 48.1649 34.6902L48.1274 34.7075L48.0899 34.728C39.7106 39.2186 33.6393 42.1888 30.043 43.5551C29.2862 43.8476 28.5592 43.9938 27.8712 43.9938C25.4727 43.9938 23.7152 42.2516 23.501 39.6573L23.4947 39.5771C23.4932 39.5205 23.49 39.4356 23.4885 39.4293L23.3055 36.7311L20.9117 37.9623C15.8488 40.5677 10.6749 43.1699 7.11621 44.5583L7.0177 44.596C6.24529 44.8743 5.53699 45.008 4.85214 45.008Z"
                                fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M59.3729 17.4425C55.9956 13.8199 44.5157 5.78361 39.9 5.6704C27.7432 5.33078 45.8651 19.3655 47.3286 21.5165C51.3799 25.8168 26.2797 29.7792 26.6174 39.4003C26.73 40.7588 27.518 41.2117 28.9815 40.6456C34.046 38.7211 43.3884 33.7415 46.7657 31.9301C51.494 29.6659 65.5631 23.8939 59.3729 17.4425ZM38.8868 16.4237C35.2843 12.5746 22.9039 3.97227 17.8379 3.74585C4.66939 3.40622 24.2533 18.5731 25.8294 20.9504C30.3325 25.592 3.0933 29.7792 3.54361 40.1928C3.54361 41.7777 4.44423 42.2306 6.02033 41.6645C11.5351 39.5135 21.553 34.0811 25.268 32.2698C30.3325 29.6659 45.5289 23.441 38.8868 16.4237Z"
                                fill="#EF5223"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1191 6.00955C15.1191 6.57559 16.0198 7.93409 16.3575 8.27372C17.3707 9.85864 18.8342 11.3304 20.071 12.6873C21.5345 14.159 22.998 15.5175 24.5741 16.9892C25.3622 17.6685 26.6005 18.8006 27.276 19.8194C27.8389 20.3855 28.1766 21.1779 28.1766 21.9704C28.1766 22.0836 28.1766 22.0836 28.1766 22.1968C28.8521 21.9704 29.415 21.8572 30.0904 21.744C33.0175 21.0647 35.8303 20.4987 38.6448 20.0458C38.6448 19.1402 38.0819 18.3477 37.519 17.7817C34.3668 14.3854 22.2115 5.78313 17.821 5.66992C17.3707 5.66992 15.682 5.66992 15.1191 6.00955Z"
                                fill="#F26C21"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M37.6133 7.81966C37.7259 9.17816 41.2158 12.9125 42.1149 13.8182C43.4658 15.1767 44.8167 16.422 46.1661 17.7805C46.5038 18.1201 46.9542 18.4597 47.517 18.9126C51.1196 18.6861 54.6079 18.5729 57.8727 18.5729C54.8331 15.5163 43.9161 7.70645 39.8633 7.59324C39.4145 7.48003 38.0636 7.59324 37.6133 7.81966Z"
                                fill="#F26C21"></path>
                        </g>
                    </svg></button>
            </form>


        </div>
        <div class="header__top__signin">
            <div class="header__top__signin__icon">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                    xmlns="https://www.w3.org/2000/svg" class="IconDefaultProfileLogo">
                    <mask id="mask0" maskUnits="userSpaceOnUse" x="0" y="0" width="28" height="28"
                        style="mask-type: alpha;">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.6375 13.5625C20.6063 12.2062 21.875 9.975 21.875 7.4375C21.875 3.325 18.55 0 14.4375 0C10.325 0 7 3.325 7 7.4375C7 9.975 8.26875 12.2062 10.2375 13.5625C6.34375 14.7875 3.5 18.4625 3.5 22.75V28H25.375V22.75C25.375 18.4625 22.5312 14.7875 18.6375 13.5625Z"
                            fill="#347BBE"></path>
                    </mask>
                    <g mask="url(#mask0)">
                        <circle cx="14.5" cy="11.5" r="15.5" fill="#C4C4C4"></circle>
                    </g>
                </svg>
            </div>
            <div class="header__top__signin__text">
                <div id="userStatusContainer" style="display: none;">
                    <p>Olá, <span id="userNameDisplay"></span>!</p>
                    <p><a href="javascript:void(0)" id="logoutButton">Sair</a></p>
                </div>

                <div id="userGuestContainer">
                    <p><a class="open_modal" id="login" href="javascript:void(0)" target="_blank">ENTRE</a> ou<br><a
                            class="open_modal" id="register" href="javascript:void(0)" target="_blank">CADASTRE-SE</a>
                    </p>
                </div>
            </div>
        </div>
        <div class = "header__top__navbar">
            <a href = "/admin/pedidos" id = "userOrdersButton" class = "header__top__navbar__item">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="" aria-hidden="true">
                    <path
                        d="M12.7236 6.21429C13.6112 6.21429 14.3308 5.49474 14.3308 4.60714C14.3308 3.71954 13.6112 3 12.7236 3C11.836 3 11.1165 3.71954 11.1165 4.60714C11.1165 5.49474 11.836 6.21429 12.7236 6.21429Z"
                        fill="#ffffffcc"></path>
                    <path
                        d="M5.72212 8.41945L10.5808 8.89286V12.6429L10.0968 19.5215C10.069 19.856 10.3329 20.1429 10.6686 20.1429C10.9318 20.1429 11.1613 19.9637 11.2251 19.7083L12.4638 13.6823C12.5314 13.4118 12.9159 13.4118 12.9835 13.6823L14.2221 19.7083C14.286 19.9637 14.5155 20.1429 14.7787 20.1429C15.1143 20.1429 15.3783 19.856 15.3504 19.5215L14.8665 12.6429V8.89286L19.7252 8.41945C20.0099 8.38386 20.2236 8.14178 20.2236 7.85478C20.2236 7.54049 19.9689 7.28571 19.6546 7.28571H5.7927C5.47841 7.28571 5.22363 7.54049 5.22363 7.85478C5.22363 8.14178 5.43734 8.38386 5.72212 8.41945Z"
                        fill="#ffffffcc"></path>
                    <path
                        d="M12.7236 0C6.09622 0 0.723633 5.37258 0.723633 12C0.723633 18.6274 6.09622 24 12.7236 24C19.351 24 24.7236 18.6274 24.7236 12C24.7236 5.37258 19.351 0 12.7236 0ZM2.22363 12C2.22363 6.20101 6.92464 1.5 12.7236 1.5C18.5226 1.5 23.2236 6.20101 23.2236 12C23.2236 17.799 18.5226 22.5 12.7236 22.5C6.92464 22.5 2.22363 17.799 2.22363 12Z"
                        fill="#ffffffcc"></path>
                </svg>
            </a>
            <a href="/cart" id = "cartButton" class = "header__top__navbar__item">
                <svg width="20" height="20" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"
                    class="IconHeaderCart" size="20" aria-hidden="true">
                    <g opacity="0.8">
                        <path
                            d="M7.19975 19.2C5.8798 19.2 4.81184 20.28 4.81184 21.6C4.81184 22.92 5.8798 24 7.19975 24C8.51971 24 9.59967 22.92 9.59967 21.6C9.59967 20.28 8.51971 19.2 7.19975 19.2ZM0 0V2.4H2.39992L6.71977 11.508L5.09982 14.448C4.90783 14.784 4.79984 15.18 4.79984 15.6C4.79984 16.92 5.8798 18 7.19975 18H21.5993V15.6H7.70374C7.53574 15.6 7.40375 15.468 7.40375 15.3L7.43974 15.156L8.51971 13.2H17.4594C18.3594 13.2 19.1513 12.708 19.5593 11.964L23.8552 4.176C23.9542 3.99286 24.004 3.78718 23.9997 3.57904C23.9955 3.37089 23.9373 3.16741 23.8309 2.98847C23.7245 2.80952 23.5736 2.66124 23.3927 2.55809C23.2119 2.45495 23.0074 2.40048 22.7992 2.4H5.05183L3.92387 0H0ZM19.1993 19.2C17.8794 19.2 16.8114 20.28 16.8114 21.6C16.8114 22.92 17.8794 24 19.1993 24C20.5193 24 21.5993 22.92 21.5993 21.6C21.5993 20.28 20.5193 19.2 19.1993 19.2Z"
                            fill="white"></path>
                    </g>
                </svg>
            </a>
        </div>

    </div>
    <div class = "header__bottom">
        @foreach ($header_items as $item)
            <div class = "header__bottom__item">
                <div class = "header__bottom__item__title">
                    <a>
                        <h1>{{ $item['title'] }}</h1>
                        @if (isset($item['subcat']))
                            <svg width="12" height="12" viewBox="0 0 25 24" fill="none"
                                xmlns="https://www.w3.org/2000/svg" class="IconCollapseHeader">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.0908203 16.909L2.27264 19.0908L12.0908 9.27264L21.909 19.0908L24.0908 16.909L12.0908 4.909L0.0908203 16.909Z"
                                    fill="#ffffffff"></path>
                            </svg>
                        @endif
                    </a>
                </div>
                <div class = "header__bottom__item__nav nav-off">
                    @if (isset($item['subcat']))
                        @foreach ($item['subcat'] as $subcat)
                            <a href="{{ route('product-filter', ['q' => $subcat['id']]) }}"
                                class="header__bottom__item__nav__option">
                                <p>{{ $subcat['name'] }}</p>
                                <svg width="0.75rem" height="0.75rem" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="IconCollapseHeader">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.0908203 16.909L2.27264 19.0908L12.0908 9.27264L21.909 19.0908L24.0908 16.909L12.0908 4.909L0.0908203 16.909Z"
                                        fill="#42464dff"></path>
                                </svg>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div id="registerModal" class="modal off registerModal">
        <div class="modal__item">
            <div class="modal__item__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                    fill="none">
                    <path
                        d="M2.75272 10.628C2.71208 10.6686 2.67983 10.7169 2.65784 10.77C2.63584 10.8231 2.62451 10.88 2.62451 10.9375C2.62451 10.995 2.63584 11.0519 2.65784 11.105C2.67983 11.1581 2.71208 11.2064 2.75272 11.247C2.79337 11.2877 2.84163 11.3199 2.89474 11.3419C2.94785 11.3639 3.00477 11.3752 3.06226 11.3752C3.11974 11.3752 3.17666 11.3639 3.22977 11.3419C3.28288 11.3199 3.33114 11.2877 3.37179 11.247L6.99976 7.61851L10.6277 11.247C10.7098 11.3291 10.8212 11.3752 10.9373 11.3752C11.0534 11.3752 11.1647 11.3291 11.2468 11.247C11.3289 11.1649 11.375 11.0536 11.375 10.9375C11.375 10.8214 11.3289 10.7101 11.2468 10.628L7.61827 7L11.2468 3.37203C11.3289 3.28994 11.375 3.1786 11.375 3.0625C11.375 2.9464 11.3289 2.83506 11.2468 2.75297C11.1647 2.67088 11.0534 2.62476 10.9373 2.62476C10.8212 2.62476 10.7098 2.67088 10.6277 2.75297L6.99976 6.38148L3.37179 2.75297C3.28969 2.67088 3.17835 2.62476 3.06226 2.62476C2.94616 2.62476 2.83482 2.67088 2.75272 2.75297C2.67063 2.83506 2.62451 2.9464 2.62451 3.0625C2.62451 3.1786 2.67063 3.28994 2.75272 3.37203L6.38124 7L2.75272 10.628Z"
                        fill="white" />
                </svg>
            </div>
            <div class="modal__item__form">
                <form class="user-form" id="registerForm">
                    <h2>Cadastro</h2>
                    <div class="form-group">
                        <label for="register-name">Nome</label>
                        <input type="text" id="register-name" name="name" required
                            placeholder="Digite seu nome">
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" required
                            placeholder="Digite seu email">
                    </div>
                    <div class="form-group">
                        <label for="register-password">Senha</label>
                        <input type="password" id="register-password" name="password" required
                            placeholder="Digite sua senha">
                    </div>
                    <div class="form-group">
                        <label for="register-confirm-password">Confirmação de Senha</label>
                        <input type="password" id="register-confirm-password" name="confirm-password" required
                            placeholder="Confirme sua senha">
                    </div>
                    <button type="submit" class="submit-btn" id="registerSubmitBtn">Cadastrar</button>
                    <div id="registerFeedback" class="feedback-message" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
    <div id="loginModal" class="modal off loginModal">
        <div class="modal__item">
            <div class="modal__item__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                    fill="none">
                    <path
                        d="M2.75272 10.628C2.71208 10.6686 2.67983 10.7169 2.65784 10.77C2.63584 10.8231 2.62451 10.88 2.62451 10.9375C2.62451 10.995 2.63584 11.0519 2.65784 11.105C2.67983 11.1581 2.71208 11.2064 2.75272 11.247C2.79337 11.2877 2.84163 11.3199 2.89474 11.3419C2.94785 11.3639 3.00477 11.3752 3.06226 11.3752C3.11974 11.3752 3.17666 11.3639 3.22977 11.3419C3.28288 11.3199 3.33114 11.2877 3.37179 11.247L6.99976 7.61851L10.6277 11.247C10.7098 11.3291 10.8212 11.3752 10.9373 11.3752C11.0534 11.3752 11.1647 11.3291 11.2468 11.247C11.3289 11.1649 11.375 11.0536 11.375 10.9375C11.375 10.8214 11.3289 10.7101 11.2468 10.628L7.61827 7L11.2468 3.37203C11.3289 3.28994 11.375 3.1786 11.375 3.0625C11.375 2.9464 11.3289 2.83506 11.2468 2.75297C11.1647 2.67088 11.0534 2.62476 10.9373 2.62476C10.8212 2.62476 10.7098 2.67088 10.6277 2.75297L6.99976 6.38148L3.37179 2.75297C3.28969 2.67088 3.17835 2.62476 3.06226 2.62476C2.94616 2.62476 2.83482 2.67088 2.75272 2.75297C2.67063 2.83506 2.62451 2.9464 2.62451 3.0625C2.62451 3.1786 2.67063 3.28994 2.75272 3.37203L6.38124 7L2.75272 10.628Z"
                        fill="white" />
                </svg>
            </div>
            <div class="modal__item__form">
                <form id="loginForm" class="user-form">
                    @csrf
                    <h2>Login</h2>
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" required
                            placeholder="Digite seu email">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Senha</label>
                        <input type="password" id="login-password" name="password" required
                            placeholder="Digite sua senha">
                    </div>
                    <button type="submit" class="submit-btn" id="loginSubmitBtn">Entrar</button>
                    <div id="loginFeedback" class="feedback-message" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</header>
