const myApp = (function() {
    const selectors = {
        dynamicSidebar: ".js-dynamic-sidebar",
        openDynamicSidebar: ".js-open-dynamic-sidebar",
        closeDynamicSidebar: ".js-close-dynamic-sidebar",
        selectComponent: ".js-select-component",
        formInputs: ".js-form-inputs",
        removeCard: ".js-remove-card",
        addItems: ".js-add-items",
        elementCard: ".js-element-card",
        noComponents: ".js-no-components",
        form: "#form"
    };

    function init() {
        showInitialPlaceholder();
        attachEventHandlers();
    }

    function attachEventHandlers() {
        $(document).on("click", selectors.openDynamicSidebar, (e) => {
            e.preventDefault();
            openDynamicSidebar($(e.currentTarget));
        });

        $(document).on("click", selectors.closeDynamicSidebar, (e) => {
            e.preventDefault();
            closeDynamicSidebar();
        });

        $(document).on("click", selectors.selectComponent, (e) => {
            e.preventDefault();
            selectComponent($(e.currentTarget));
        });

        $(document).on("click", selectors.formInputs + " " + selectors.removeCard, (e) => {
            e.preventDefault();
            removeCard($(e.currentTarget));
        });

        $(document).on("click", selectors.addItems, (e) => {
            e.preventDefault();
            addCarouselItem($(e.currentTarget));
        });
    }

    function showInitialPlaceholder() {
        if ($(selectors.elementCard).length == 0) {
            $(selectors.noComponents).show();
        }
    }

    function openDynamicSidebar(el) {
        el.hide();
        $(selectors.dynamicSidebar).addClass("show");
    }

    function closeDynamicSidebar() {
        $(selectors.dynamicSidebar).removeClass("show");
        $(selectors.openDynamicSidebar).show();
    }

    function selectComponent(el) {
        $(selectors.noComponents).hide();
        const currentComponent = el.attr("data-component");

        const index = $(selectors.formInputs + ' ' + selectors.elementCard).not(selectors.formInputs + ' ' + selectors.elementCard + '.js-carousel-item').length;

        let template = $(`#${currentComponent}Template`).html();
        template = template.replaceAll('{index}', index);

        $(selectors.form).find(selectors.formInputs).append(template);
        _animateDown();
    }

    function addCarouselItem(el) {
        const currentCarousel = el.closest(".js-carousel");

        const itemIndex = currentCarousel.find('.js-carousel-item').length;

        let template = $('#carousel-itensTemplate').html();

        template = template.replaceAll('{itemindex}', itemIndex);

        console.log(currentCarousel.find(".js-carousel-items-container"))

        currentCarousel.find(".js-carousel-items-container").append(template);
        _animateDown();
    }

    function removeCard(el) {
        const elementCard = el.closest(selectors.elementCard);
        elementCard.hide();
        elementCard.find('.js-remove-flag').val('1');

        const allRemoved = $(selectors.elementCard).length === $(selectors.elementCard + ':has(.js-remove-flag[value="1"])').length;

        if (allRemoved) {
            $(selectors.noComponents).show();
        }
    }

    function _animateDown() {
        $("html, body").animate({
            scrollTop: $(document).height() - $(window).height()
        }, 1000);
    }

    return {
        init
    };
})();

$(function() {
    myApp.init();
});
