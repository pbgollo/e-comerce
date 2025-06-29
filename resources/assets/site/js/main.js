function init(){
    console.log('INIT');
    toggleHeaderNav();
    authModal();
    checkUserStatus(); // Nova função para verificar status do usuário
    setupLogout(); // Nova função para configurar o botão de logout
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


    // Open modal on event click
    $events.on('click', function(e) {
        console.log("clicouuuuuu");
        if($(this).attr('id')=='register'){
            console.log("register");
            e.preventDefault();
            const $modal = $(".registerModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
            // Limpar feedback anterior ao abrir o modal
            $('#registerFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#registerSubmitBtn').prop('disabled', false).text('Cadastrar'); // Reabilitar botão
        }else{
            console.log("login");
            e.preventDefault();
            const $modal = $(".loginModal");
            $modal.removeClass('off').focus();
            $modal.find('.modal__item').toggleClass('animated')
            // Limpar feedback anterior ao abrir o modal
            $('#loginFeedback').hide().removeClass('feedback-message--error feedback-message--success').text('');
            $('#loginSubmitBtn').prop('disabled', false).text('Entrar'); // Reabilitar botão
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

// Nova função para verificar o status do usuário
async function checkUserStatus() {
    try {
        const response = await fetch('/user-status', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const result = await response.json();

        const userStatusContainer = $('#userStatusContainer');
        const userNameDisplay = $('#userNameDisplay');
        const userGuestContainer = $('#userGuestContainer');

        if (result.logged_in) {
            userNameDisplay.text('Olá, ' + result.user_name);
            userStatusContainer.show();
            userGuestContainer.hide();
        } else {
            userStatusContainer.hide();
            userGuestContainer.show();
        }
    } catch (error) {
        console.error('Erro ao verificar status do usuário:', error);
        // Em caso de erro, assumir que o usuário não está logado
        $('#userStatusContainer').hide();
        $('#userGuestContainer').show();
    }
}

// Nova função para configurar o botão de logout
function setupLogout() {
    $('#logoutButton').on('click', async function(e) {
        e.preventDefault();
        try {
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const result = await response.json();

            if (result.success) {
                alert('Logout realizado com sucesso!');
                checkUserStatus(); // Atualiza o header após o logout
            } else {
                alert(result.message || 'Erro ao fazer logout.');
            }
        } catch (error) {
            console.error('Erro ao fazer logout:', error);
            alert('Erro na conexão com o servidor ao tentar fazer logout.');
        }
    });
}


$(function() {
    init();
});
