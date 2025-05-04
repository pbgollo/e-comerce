import { Slider } from "./../components/slider";

import EmblaCarousel from "embla-carousel";
import Autoplay from "embla-carousel-autoplay";

function init() {
    productSlider_01();
    productSlider_02();
}

function productSlider_01() {
    console.log("função 1");
    const emblaNode = $(".products_pics-embla");
    const prevBtn = $(".products_pics-embla-prev");
    const nextBtn = $(".products_pics-embla-next");

    prevBtn.on("click", () => emblaApi.scrollPrev());
    nextBtn.on("click", () => {
        emblaApi.scrollNext();
        console.log("pegou o click");
    });

    const options = {
        loop: false,
        draggable: true,
        draggable: true,
        // containScroll: "trimSnaps",
        slidesToScroll: 1,
        // slidesToShow: 4,
        speed: 10,
        axis: 'y'
    };
    // const plugins = [Autoplay({ delay: 4000, stopOnInteraction: false })];
    // const emblaApi = EmblaCarousel(emblaNode[0], options, plugins);

    const emblaApi = EmblaCarousel(emblaNode[0], options);


    emblaApi.on("init", () => {
        console.log("emblaApi initialized with options:", options);
    });

    // Revalida após 1 segundo para conteúdo dinâmico
    setTimeout(() => {
        emblaApi.reInit();
        console.log("Embla re-initialized");
    }, 1000);
}



function productSlider_02() {
    console.log("função 2");
    const emblaNode = $(".related_pics-embla");
    const prevBtn = $(".related_pics-embla-prev");
    const nextBtn = $(".related_pics-embla-next");

    prevBtn.on("click", () => emblaApi.scrollPrev());
    nextBtn.on("click", () => {
        emblaApi.scrollNext();
        console.log("pegou o click");
    });

    const options = {
        loop: false,
        draggable: true,
        draggable: true,
        // containScroll: "trimSnaps",
        slidesToScroll: 1,
        slidesToScroll: 1,
        speed: 10,
    };
    // const plugins = [Autoplay({ delay: 4000, stopOnInteraction: false })];
    // const emblaApi = EmblaCarousel(emblaNode[0], options, plugins);

    const emblaApi = EmblaCarousel(emblaNode[0], options);


    // Revalida após 1 segundo para conteúdo dinâmico
    setTimeout(() => {
        emblaApi.reInit();
        console.log("Embla re-initialized");
    }, 1000);
}

$(function () {
    init();
});
