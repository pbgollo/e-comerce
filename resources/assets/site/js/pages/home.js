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

    prevBtn.on('click', () => emblaApi.scrollPrev());
    nextBtn.on('click', () => {
        emblaApi.scrollNext()
        console.log('pegou o click')
    });

    const options = {
        loop: false,
        draggable: true,
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


function login(){
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
}

function register() {
    document.getElementById('registerForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = document.getElementById('register-name').value.trim();
        const email = document.getElementById('register-email').value.trim();
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm-password').value;

        // Exiba erro se as senhas não coincidirem
        if (password !== confirmPassword) {
            alert('As senhas não coincidem.');
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
                alert('Cadastro realizado com sucesso!');
                // Ex: redirecionar ou fechar modal
                // window.location.href = '/login';
            } else {
                alert(result.message || 'Erro ao realizar cadastro.');
                console.error(result.errors); // opcional: exibir detalhes no console
            }
        } catch (error) {
            alert('Erro na conexão com o servidor.');
            console.error(error);
        }
    });
}

$(function () {
    init();
});
