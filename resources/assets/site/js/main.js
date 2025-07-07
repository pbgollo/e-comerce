import AppUserService from "./services/appUserService.js";
import OrderService from "./services/orderService.js";
import CartManager from "./services/cartManager.js";

function init() {
    console.log("INIT");
    toggleHeaderNav();
    authModal();
    handleRegister();
    handleLogin();
    handleLogout();
    loadUserInfo();
    setupAddToCartButtons();
    productSearch();
    productFilter();
}

function productSearch() {
    const $container = $(".home__listing__items");

    // === BUSCA POR PALAVRAS ===
    $("#product-search-form").on("submit", function (e) {
        e.preventDefault();
        const query = $(this).find('input[name="q"]').val();

        $.ajax({
            url: $(this).attr("action"),
            data: { q: query },
            success: function (response) {
                $container.find(".js-product").hide(); // esconde antigos
                $container.html(response.html); // adiciona novos
            },
        });
    });
}

function productFilter() {
    const $container = $(".home__listing__items");

    // === FILTRO POR CATEGORIA ===
    $(".header__bottom__item__nav__option").on("click", function (e) {
        e.preventDefault();
        const url = $(this).attr("href");

        $.ajax({
            url: url,
            success: function (response) {
                $container.find(".js-product").hide();
                $container.html(response.html);
            },
        });
    });
}

function setupAddToCartButtons() {
    const addToCartButtons = document.querySelectorAll(
        ".js-add-to-cart-button"
    );
    const directBuyButtons = document.querySelectorAll(".js-buy-button");

    directBuyButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            console.log("clicou no direct buy");

            event.preventDefault();
            event.stopPropagation();

            const productCard = event.target.closest(".js-product");
            if (productCard) {
                const productId = parseInt(productCard.dataset.id);
                let quantity = 1; // Padrão, outras quantidades são definidas no checkout

                if (isNaN(productId)) {
                    console.error(
                        "ID do produto inválido. Verifique o atributo data-id."
                    );
                    return;
                }

                CartManager.addItem(productId, quantity);
                window.location.href = "/cart";
            }
        });
    });

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            console.log("clicou no add cart");

            event.preventDefault();
            event.stopPropagation();

            const productCard = event.target.closest(".js-product");
            if (productCard) {
                const productId = parseInt(productCard.dataset.id);

                let quantity = 1; // Padrão, outras quantidades são definidas no checkout

                if (isNaN(productId)) {
                    console.error(
                        "ID do produto inválido. Verifique o atributo data-id."
                    );
                    return;
                }

                CartManager.addItem(productId, quantity);

                alert(`Produto adicionado ao carrinho!`);
            }
        });
    });
}

function handleRegister() {
    $("#registerForm").on("submit", async function (e) {
        e.preventDefault();
        const name = $("#register-name").val();
        const email = $("#register-email").val();
        const password = $("#register-password").val();
        const confirmPassword = $("#register-confirm-password").val();
        const $feedback = $("#registerFeedback");

        if (password !== confirmPassword) {
            $feedback
                .text("As senhas não coincidem.")
                .addClass("feedback-message--error")
                .show();
            return;
        }

        $("#registerSubmitBtn").prop("disabled", true).text("Cadastrando...");

        try {
            const res = await AppUserService.register(name, email, password);
            $feedback
                .text(res.message)
                .removeClass("feedback-message--error")
                .addClass("feedback-message--success")
                .show();
            $("#registerForm")[0].reset();
        } catch (error) {
            const message = error.message || "Erro ao cadastrar.";
            $feedback.text(message).addClass("feedback-message--error").show();
        } finally {
            $("#registerSubmitBtn").prop("disabled", false).text("Cadastrar");
        }
    });
}

function handleLogin() {
    $("#loginForm").on("submit", async function (e) {
        e.preventDefault();
        const email = $("#login-email").val();
        const password = $("#login-password").val();
        const $feedback = $("#loginFeedback");

        $("#loginSubmitBtn").prop("disabled", true).text("Entrando...");

        try {
            const res = await AppUserService.login(email, password);
            localStorage.setItem("token", res.token); // Armazena o token JWT

            $feedback
                .text("Login realizado com sucesso!")
                .removeClass("feedback-message--error")
                .addClass("feedback-message--success")
                .show();

            $("#loginForm")[0].reset();

            // Fecha o modal
            $(".loginModal")
                .addClass("off")
                .find(".modal__item")
                .removeClass("animated");

            // Atualiza UI com nome do usuário
            await loadUserInfo();
        } catch (error) {
            const message = error?.message || "Erro ao fazer login.";
            $feedback.text(message).addClass("feedback-message--error").show();
        } finally {
            $("#loginSubmitBtn").prop("disabled", false).text("Entrar");
        }
    });
}

async function handleLogout() {
    $("#logoutButton").on("click", async function () {
        const token = localStorage.getItem("token");
        if (!token) return;
        // localStorage.removeItem("token");
        localStorage.clear();
        window.location.href = "";
        $("#userStatusContainer").hide();
        $("#userGuestContainer").show();
    });
}

async function loadUserInfo() {
    const token = localStorage.getItem("token");
    if (!token) return;

    try {
        const res = await AppUserService.getCurrentUser(token);

        $("#userNameDisplay").text(res.user.name);
        $("#userStatusContainer").show();
        $("#userGuestContainer").hide();
    } catch (e) {
        // Token inválido? Limpa dados
        localStorage.removeItem("token");
        $("#userStatusContainer").hide();
        $("#userGuestContainer").show();
    }
}

// function loadOrders() {
//     $("#userOrdersButton").on("click", async function (e) {
//         e.preventDefault();
//         try {
//             let admin = await isAdmin();
//             if (admin === true) {
//                 console.log("é admin");
//                 window.location.href = "/admin/pedidos";
//             } else {
//                 console.log("é usuário");
//                 window.location.href = "/user/pedidos";
//             }
//         } catch (err) {
//             console.error("Erro ao verificar admin:", err);
//         }
//     });
// }

// async function isAdmin() {
//     const token = localStorage.getItem("token");
//     if (!token) return;
//     try {
//         const res = await AppUserService.getCurrentUser(token);
//         let userRole = res.user.role;

//         console.log(userRole);

//         if (userRole == 1) {
//             return true;
//         } else {
//             return false;
//         }
//     } catch (e) {
//         console.log(`erro: ${e}`);
//     }
// }

function toggleHeaderNav() {
    $(".header__bottom__item").on("mouseenter", function () {
        var navItem = $(this);
        navItem.children(".header__bottom__item__nav").removeClass("nav-off");
        $(window).on("click", function (e) {
            if (e.target != $(navItem)[0]) {
                $(navItem)
                    .children(".header__bottom__item__nav")
                    .addClass("nav-off");
            }
        });
    });

    $(".header__bottom__item__nav").on("mouseleave", function () {
        $(this).addClass("nav-off");
    });
}

function authModal() {
    const $events = $(".open_modal");
    const $modals = $(".modal");
    const $closeButtons = $(".modal__item__close");

    $events.on("click", function (e) {
        if ($(this).attr("id") == "register") {
            console.log("register");
            e.preventDefault();
            const $modal = $(".registerModal");
            $modal.removeClass("off").focus();
            $modal.find(".modal__item").toggleClass("animated");
            $("#registerFeedback")
                .hide()
                .removeClass(
                    "feedback-message--error feedback-message--success"
                )
                .text("");
            $("#registerSubmitBtn").prop("disabled", false).text("Cadastrar");
            $("#registerFeedback")
                .hide()
                .removeClass(
                    "feedback-message--error feedback-message--success"
                )
                .text("");
            $("#registerSubmitBtn").prop("disabled", false).text("Cadastrar");
        } else {
            console.log("login");
            e.preventDefault();
            const $modal = $(".loginModal");
            $modal.removeClass("off").focus();
            $modal.find(".modal__item").toggleClass("animated");
            $("#loginFeedback")
                .hide()
                .removeClass(
                    "feedback-message--error feedback-message--success"
                )
                .text("");
            $("#loginSubmitBtn").prop("disabled", false).text("Entrar");
            $("#loginFeedback")
                .hide()
                .removeClass(
                    "feedback-message--error feedback-message--success"
                )
                .text("");
            $("#loginSubmitBtn").prop("disabled", false).text("Entrar");
        }
    });

    $closeButtons.on("click", function (e) {
        e.stopPropagation();
        $(this).closest(".modal").addClass("off");
        $(this).closest(".modal").find(".modal__item").toggleClass("animated");
    });

    $(document).on("click", function (e) {
        if (
            !$(e.target).closest(".modal__item").length &&
            !$(e.target).closest(".open_modal").length
        ) {
            $modals.addClass("off");
            $modals.find(".modal__item").removeClass("animated");
        }
    });

    $(document).on("keydown", function (e) {
        if (e.key === "Escape") {
            $modals.addClass("off");
            $modals.find(".modal__item").removeClass("animated");
        }
    });
}

async function getLoggedUserInfo() {
    const token = localStorage.getItem("token");
    if (!token) return;

    try {
        const res = await AppUserService.getCurrentUser(token);
        console.log(res);
    } catch (e) {
        console.log(`erro: ${e}`);
    }
}

async function getLoggedUserOrderInfo() {
    const token = localStorage.getItem("token");
    if (!token) return;
    try {
        const res = await OrderService.getOrders(token);
        console.log(res);
        return res;
    } catch (e) {
        console.log(`erro: ${e}`);
    }
}

$(function () {
    init();
    // getLoggedUserInfo();
    // getLoggedUserOrderInfo();
});
