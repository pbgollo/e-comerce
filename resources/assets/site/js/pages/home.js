import { Slider } from "./../components/slider";

import EmblaCarousel from "embla-carousel";
import Autoplay from "embla-carousel-autoplay";

function init() {
    // home_slider();
    homeBanner();
}

function home_slider() {
    new Slider("js-test", {
        autoplay: true,
        autoplaySpeed: 5000,
    });
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


$(function () {
    init();
});
