import EmblaCarousel from "embla-carousel";
import Autoplay from "embla-carousel-autoplay";

function init() {
    homeBanner();
    login();
    register();
}

function homeBanner() {
    const emblaNode = $(".home-embla");
    const prevBtn = $('.home-embla-prev');
    const nextBtn = $('.home-embla-next');

    if (emblaNode.length === 0) {
        console.warn('Embla carousel node not found. Skipping homeBanner initialization.');
        return;
    }

    prevBtn.on('click', () => emblaApi.scrollPrev());
    nextBtn.on('click', () => {
        emblaApi.scrollNext()
        console.log('pegou o click')
    });

    const options = {
        loop: false,
        draggable: true,
        containScroll: "trimSnaps",
        slidesToScroll: 1,
        speed: 10,
    };
    const plugins = [Autoplay({ delay: 4000, stopOnInteraction: false })];
    const emblaApi = EmblaCarousel(emblaNode[0], options, plugins);

    //DOTS:
    const $dotsContainer = $('.home-embla-dots');
    console.log('Dots Container:', $dotsContainer, 'Length:', $dotsContainer.length);

    if (emblaApi && $dotsContainer.length) {

        const $slides = $('.offers-banner__slides__item');
        console.log('Slides Found:', $slides, 'Length:', $slides.length);


        // Limpar dots existentes para evitar duplicação
        $dotsContainer.empty();

        // Criar um dot para cada slide
        const $dots = [];
        $slides.each((index) => {
            const $dot = $('<button>')
                .addClass('home-embla-dot')
                .attr('aria-label', `Go to slide ${index + 1}`);
            $dot.on('click', () => emblaApi.scrollTo(index));
            $dotsContainer.append($dot);
            $dots.push($dot);
        });

        const updateDots = () => {
            const selectedIndex = emblaApi.selectedScrollSnap();
            $dots.forEach(($dot, index) => {
                $dot.toggleClass('is-selected', index === selectedIndex);
            });
        };

        emblaApi.on('init', () => {
            console.log('emblaApi initialized with options:', options);
            updateDots();
        });
        emblaApi.on('select', updateDots);
        updateDots();

        // Revalida após 1 segundo para conteúdo dinâmico
        setTimeout(() => {
            emblaApi.reInit();
            console.log('Embla re-initialized');
        }, 1000);
    } else {
        console.warn('Dots container not found or Embla not initialized.');
    }
}


function login() {
    const loginForm = document.getElementById('loginForm');
    if (!loginForm) return; // Garante que o formulário existe

    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        const loginFeedback = document.getElementById('loginFeedback');
        const loginSubmitBtn = document.getElementById('loginSubmitBtn');

        // Resetar feedback visual
        loginFeedback.style.display = 'none';
        loginFeedback.classList.remove('feedback-message--error', 'feedback-message--success');
        loginSubmitBtn.disabled = true; // Desabilita o botão para evitar cliques múltiplos
        loginSubmitBtn.textContent = 'Carregando...';

        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            const result = await response.json();

            if (result.success) {
                loginFeedback.textContent = 'Login realizado com sucesso!';
                loginFeedback.classList.add('feedback-message--success');
                loginFeedback.style.display = 'block';
                // Fechar modal ou redirecionar
                setTimeout(() => {
                    $('.loginModal').addClass('off');
                    $('.loginModal').find('.modal__item').removeClass('animated');
                    // Atualizar o status do usuário no header
                    if (typeof checkUserStatus === 'function') {
                        checkUserStatus();
                    }
                }, 1500); // Dá um tempo para o usuário ver a mensagem de sucesso
            } else {
                loginFeedback.textContent = result.message || 'Erro ao fazer login.';
                loginFeedback.classList.add('feedback-message--error');
                loginFeedback.style.display = 'block';
            }
        } catch (error) {
            console.error('Erro na requisição de login:', error);
            loginFeedback.textContent = 'Erro na conexão com o servidor. Tente novamente.';
            loginFeedback.classList.add('feedback-message--error');
            loginFeedback.style.display = 'block';
        } finally {
            loginSubmitBtn.disabled = false; // Reabilita o botão
            loginSubmitBtn.textContent = 'Entrar';
        }
    });
}

function register() {
    const registerForm = document.getElementById('registerForm');
    if (!registerForm) return; // Garante que o formulário existe

    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = document.getElementById('register-name').value.trim();
        const email = document.getElementById('register-email').value.trim();
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm-password').value;
        const registerFeedback = document.getElementById('registerFeedback');
        const registerSubmitBtn = document.getElementById('registerSubmitBtn');

        // Resetar feedback visual
        registerFeedback.style.display = 'none';
        registerFeedback.classList.remove('feedback-message--error', 'feedback-message--success');
        registerSubmitBtn.disabled = true; // Desabilita o botão para evitar cliques múltiplos
        registerSubmitBtn.textContent = 'Carregando...';

        // Exiba erro se as senhas não coincidirem
        if (password !== confirmPassword) {
            registerFeedback.textContent = 'As senhas não coincidem.';
            registerFeedback.classList.add('feedback-message--error');
            registerFeedback.style.display = 'block';
            registerSubmitBtn.disabled = false;
            registerSubmitBtn.textContent = 'Cadastrar';
            return;
        }

        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name,
                    email,
                    password
                })
            });

            const result = await response.json();

            if (result.success) {
                registerFeedback.textContent = 'Cadastro realizado com sucesso! Você pode fazer login agora.';
                registerFeedback.classList.add('feedback-message--success');
                registerFeedback.style.display = 'block';
                // Opcional: fechar modal de registro e abrir o de login automaticamente
                setTimeout(() => {
                    $('.registerModal').addClass('off');
                    $('.registerModal').find('.modal__item').removeClass('animated');
                    // Abrir modal de login se desejado
                    // $('#login').trigger('click');
                }, 2000);
            } else {
                let errorMessage = result.message || 'Erro ao realizar cadastro.';
                if (result.errors) {
                    // Concatenar mensagens de erro de validação
                    errorMessage += '<br>' + Object.values(result.errors).map(err => err.join(', ')).join('<br>');
                }
                registerFeedback.innerHTML = errorMessage; // Usar innerHTML para <br>
                registerFeedback.classList.add('feedback-message--error');
                registerFeedback.style.display = 'block';
                console.error(result.errors);
            }
        } catch (error) {
            console.error('Erro na requisição de registro:', error);
            registerFeedback.textContent = 'Erro na conexão com o servidor. Tente novamente.';
            registerFeedback.classList.add('feedback-message--error');
            registerFeedback.style.display = 'block';
        } finally {
            registerSubmitBtn.disabled = false; // Reabilita o botão
            registerSubmitBtn.textContent = 'Cadastrar';
        }
    });
}

$(function () {
    init();
});
