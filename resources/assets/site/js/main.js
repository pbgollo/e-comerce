import AppUserService from './services/appUserService.js';

function init(){
    console.log('INIT');
    toggleHeaderNav();
    authModal();
    handleRegister();
    handleLogin();
    loadUserInfo();
}

function handleRegister() {
    $('#registerForm').on('submit', async function (e) {
        e.preventDefault();
        const name = $('#register-name').val();
        const email = $('#register-email').val();
        const password = $('#register-password').val();
        const confirmPassword = $('#register-confirm-password').val();
        const $feedback = $('#registerFeedback');

        if (password !== confirmPassword) {
            $feedback.text('As senhas não coincidem.').addClass('feedback-message--error').show();
            return;
        }

        $('#registerSubmitBtn').prop('disabled', true).text('Cadastrando...');

        try {
            const res = await AppUserService.register(name, email, password);
            $feedback.text(res.message).removeClass('feedback-message--error').addClass('feedback-message--success').show();
            $('#registerForm')[0].reset();
        } catch (error) {
            const message = error.message || 'Erro ao cadastrar.';
            $feedback.text(message).addClass('feedback-message--error').show();
        } finally {
            $('#registerSubmitBtn').prop('disabled', false).text('Cadastrar');
        }
    });
}

function handleLogin() {
    $('#loginForm').on('submit', async function (e) {
        e.preventDefault();
        const email = $('#login-email').val();
        const password = $('#login-password').val();
        const $feedback = $('#loginFeedback');

        $('#loginSubmitBtn').prop('disabled', true).text('Entrando...');

        try {
            const res = await AppUserService.login(email, password);
            localStorage.setItem('token', res.token); // Armazena o token JWT

            $feedback.text('Login realizado com sucesso!')
                     .removeClass('feedback-message--error')
                     .addClass('feedback-message--success')
                     .show();

            $('#loginForm')[0].reset();

            // Fecha o modal
            $('.loginModal').addClass('off').find('.modal__item').removeClass('animated');

            // Atualiza UI com nome do usuário
            await loadUserInfo();

        } catch (error) {
            const message = error?.message || 'Erro ao fazer login.';
            $feedback.text(message).addClass('feedback-message--error').show();
        } finally {
            $('#loginSubmitBtn').prop('disabled', false).text('Entrar');
        }
    });
}

async function loadUserInfo() {
    const token = localStorage.getItem('token');
    if (!token) return;

    try {
        const res = await AppUserService.getCurrentUser(token);

        $('#userNameDisplay').text(res.user.name);
        $('#userStatusContainer').show();
        $('#userGuestContainer').hide();
    } catch (e) {
        // Token inválido? Limpa dados
        localStorage.removeItem('token');
        $('#userStatusContainer').hide();
        $('#userGuestContainer').show();
    }
}

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

    $events.on('click', function(e) {
        console.log("clicouuuuuu");
        if($(this).attr('id')=='register'){
            console.log("register");
            e.preventDefault();
            const $modal = $(".registerModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
            $('#registerFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#registerSubmitBtn').prop('disabled', false).text('Cadastrar');
            $('#registerFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#registerSubmitBtn').prop('disabled', false).text('Cadastrar');
        }else{
            console.log("login");
            e.preventDefault();
            const $modal = $(".loginModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
            $('#loginFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#loginSubmitBtn').prop('disabled', false).text('Entrar');
            $('#loginFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#loginSubmitBtn').prop('disabled', false).text('Entrar');
        }
    });

    $closeButtons.on('click', function(e) {
        e.stopPropagation();
        $(this).closest('.modal').addClass('off');
        $(this).closest('.modal').find('.modal__item').toggleClass('animated');

    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.modal__item').length && !$(e.target).closest('.open_modal').length) {
            $modals.addClass('off');
            $modals.find('.modal__item').removeClass('animated');

        }
    });

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
