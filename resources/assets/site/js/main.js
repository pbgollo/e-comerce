function init(){
    console.log('INIT');
    // toggleMobileMenu();
    toggleHeaderNav();
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

$(function() {
    init();
});
