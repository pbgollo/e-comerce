function init(){
    console.log('INIT');
    // toggleMobileMenu();
    toggleHeaderNav();
    authModal();
}

// function toggleMobileMenu(){
//     $('.js-hamburger').on('click',function(){
//         $('.js-hamburger').toggleClass('open');
//         const mobileMenu = $(".js-mobile");

//         if (mobileMenu.hasClass("show")) {
//             // Closing the menu - trigger fadeOut animation
//             mobileMenu.removeClass("show");
//             mobileMenu.addClass("hiding");

//             // Remove hiding class after animation completes
//             setTimeout(() => {
//                 mobileMenu.removeClass("hiding");
//             }, 300); // Match animation duration (0.3s)
//         } else {
//             // Opening the menu
//             mobileMenu.addClass("show");
//         }

//         document.querySelector('body').classList.toggle('freeze');
//     });
// }

function toggleHeaderNav(){
    $('.header__bottom__item').on('mouseenter', function(){
        var navItem = $(this);
        navItem.children('.header__bottom__item__nav').removeClass('nav-off');
        $(window).on('click', function(e){
            if(e.target != $(navItem)[0]){
                $(navItem).children('.header__bottom__item__nav').addClass('nav-off');

            }
        })
    });

    $('.header__bottom__item__nav').on('mouseleave', function(){
        $(this).addClass('nav-off');
    })

}

function authModal() {
    const $events = $('.open_modal');
    const $modals = $('.modal');
    const $closeButtons = $('.modal__item__close');


    // Open modal on event click
    $events.on('click', function(e) {
        console.log("clicouuuuuu");
        if($(this).attr('id')=='register'){
            console.log("register");
            e.preventDefault();
            const $modal = $(".registerModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
        }else{
            console.log("login");
            e.preventDefault();
            const $modal = $(".loginModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
        }
    });

    // Close modal on close button click
    $closeButtons.on('click', function(e) {
        e.stopPropagation();
        $(this).closest('.modal').addClass('off');
        $(this).closest('.modal').find('.modal__item').toggleClass('animated');

    });

    // Close modal on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.modal__item').length && !$(e.target).closest('.open_modal').length) {
            $modals.addClass('off');
            $modals.find('.modal__item').removeClass('animated');

        }
    });

    // Close modal on Esc key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $modals.addClass('off');
            $modals.find('.modal__item').removeClass('animated');

        }
    });
}

$(function() {
    init();
});
