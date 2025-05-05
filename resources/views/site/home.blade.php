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
            $product = array_merge(
                [
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
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_2.jpg',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_3.jpg',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_4.jpg',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_5.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_6.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_7.jpg',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_8.jpg',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_9.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_10.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_11.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_12.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                        [
                            'path' => 'assets/site/images/other_products_13.webp',
                            'price' => 'R$ 3.999,00',
                        ],
                    ],
                    'brand_logo' => 'assets/site/images/logo_lg.jpg',
                ],
                $product,
            );
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

        <!-- Cadastro -->
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
                    <form class="user-form">
                        <h2>Cadastro</h2>
                        <div class="form-group">
                            <label for="register-name">Nome</label>
                            <input type="text" id="register-name" name="name" required placeholder="Digite seu nome">
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
                        <button type="submit" class="submit-btn">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Login -->
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
                            <input type="email" id="login-email" name="email" required placeholder="Digite seu email">
                        </div>
                        <div class="form-group">
                            <label for="login-password">Senha</label>
                            <input type="password" id="login-password" name="password" required
                                placeholder="Digite sua senha">
                        </div>
                        <button type="submit" class="submit-btn">Entrar</button>
                    </form>
                    <div id="loginError"
                        style="color: red; display: none; font-size: 14px; text-align: center; margin-top: 1rem;"></div>

                </div>
            </div>
        </div>

    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const loginError = document.getElementById('loginError');

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const result = await response.json();

                if (result.success) {
                    // sucesso: redireciona ou fecha o modal
                    loginError.style.display = 'none';
                    alert('Login realizado com sucesso!');
                    // Ex: window.location.href = '/painel';
                } else {
                    loginError.textContent = result.message || 'Erro ao fazer login.';
                    loginError.style.display = 'block';
                }
            } catch (error) {
                loginError.textContent = 'Erro na conexão com o servidor.';
                loginError.style.display = 'block';
            }
        });
    </script>
@endsection
