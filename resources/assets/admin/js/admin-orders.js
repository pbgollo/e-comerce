// Simulação de dados de pedidos para o frontend
const allOrders = [
    {
        id: '0001',
        client_name: 'João Silva',
        order_date: '2025-06-20',
        total_value: 970.16,
        status: 'shipped',
        shipping_date: '2025-06-22',
        cancellation_date: null,
        items: [
            {
                product_name: 'Monitor Gamer LG UltraGear 24GS60F-B',
                product_image: 'https://via.placeholder.com/80x80?text=Monitor', // Placeholder
                quantity: 1,
                unit_price: 875.72,
                total_item_value: 875.72,
                product_pictures: [
                    'https://via.placeholder.com/150x150?text=Monitor+1',
                    'https://via.placeholder.com/150x150?text=Monitor+2',
                    'https://via.placeholder.com/150x150?text=Monitor+3'
                ]
            },
            {
                product_name: 'Teclado Mecânico RGB',
                product_image: 'https://via.placeholder.com/80x80?text=Teclado', // Placeholder
                quantity: 1,
                unit_price: 94.44,
                total_item_value: 94.44,
                product_pictures: [
                    'https://via.placeholder.com/150x150?text=Teclado+1',
                    'https://via.placeholder.com/150x150?text=Teclado+2'
                ]
            }
        ]
    },
    {
        id: '0002',
        client_name: 'Maria Souza',
        order_date: '2025-06-18',
        total_value: 250.00,
        status: 'pending',
        shipping_date: null,
        cancellation_date: null,
        items: [
            {
                product_name: 'Fone de Ouvido Bluetooth',
                product_image: 'https://via.placeholder.com/80x80?text=Fone', // Placeholder
                quantity: 2,
                unit_price: 125.00,
                total_item_value: 250.00,
                product_pictures: [
                    'https://via.placeholder.com/150x150?text=Fone+1',
                    'https://via.placeholder.com/150x150?text=Fone+2',
                    'https://via.placeholder.com/150x150?text=Fone+3',
                    'https://via.placeholder.com/150x150?text=Fone+4'
                ]
            }
        ]
    },
    {
        id: '0003',
        client_name: 'Pedro Alves',
        order_date: '2025-06-15',
        total_value: 49.90,
        status: 'canceled',
        shipping_date: null,
        cancellation_date: '2025-06-16',
        items: [
            {
                product_name: 'Processador AMD Ryzen 7 5700X3D',
                product_image: 'https://via.placeholder.com/80x80?text=Processador', // Placeholder
                quantity: 1,
                unit_price: 47.40,
                total_item_value: 47.40,
                product_pictures: [
                    'https://via.placeholder.com/150x150?text=CPU+1',
                    'https://via.placeholder.com/150x150?text=CPU+2'
                ]
            }
        ]
    },
    {
        id: '0004',
        client_name: 'Ana Costa',
        order_date: '2025-06-10',
        total_value: 500.00,
        status: 'processing',
        shipping_date: null,
        cancellation_date: null,
        items: [
            {
                product_name: 'Placa de Vídeo RTX 4060',
                product_image: 'https://via.placeholder.com/80x80?text=GPU', // Placeholder
                quantity: 1,
                unit_price: 500.00,
                total_item_value: 500.00,
                product_pictures: [
                    'https://via.placeholder.com/150x150?text=GPU+1',
                    'https://via.placeholder.com/150x150?text=GPU+2',
                    'https://via.placeholder.com/150x150?text=GPU+3'
                ]
            }
        ]
    },
    // Adicione mais pedidos para testar a paginação
    { id: '0005', client_name: 'Bruno Lima', order_date: '2025-06-05', total_value: 120.00, status: 'delivered', shipping_date: '2025-06-07', cancellation_date: null, items: [{ product_name: 'Mouse Gamer', product_image: 'https://via.placeholder.com/80x80?text=Mouse', quantity: 1, unit_price: 120.00, total_item_value: 120.00, product_pictures: ['https://via.placeholder.com/150x150?text=Mouse+1'] }] },
    { id: '0006', client_name: 'Carla Pereira', order_date: '2025-06-01', total_value: 300.00, status: 'shipped', shipping_date: '2025-06-03', cancellation_date: null, items: [{ product_name: 'Webcam HD', product_image: 'https://via.placeholder.com/80x80?text=Webcam', quantity: 1, unit_price: 300.00, total_item_value: 300.00, product_pictures: ['https://via.placeholder.com/150x150?text=Webcam+1'] }] },
    { id: '0007', client_name: 'Daniel Rocha', order_date: '2025-05-28', total_value: 80.00, status: 'pending', shipping_date: null, cancellation_date: null, items: [{ product_name: 'Pen Drive 64GB', product_image: 'https://via.placeholder.com/80x80?text=Pendrive', quantity: 3, unit_price: 80.00, total_item_value: 80.00, product_pictures: ['https://via.placeholder.com/150x150?text=Pendrive+1'] }] },
    { id: '0008', client_name: 'Elisa Ferreira', order_date: '2025-05-25', total_value: 750.00, status: 'processing', shipping_date: null, cancellation_date: null, items: [{ product_name: 'SSD 1TB NVMe', product_image: 'https://via.placeholder.com/80x80?text=SSD', quantity: 1, unit_price: 750.00, total_item_value: 750.00, product_pictures: ['https://via.placeholder.com/150x150?text=SSD+1', 'https://via.placeholder.com/150x150?text=SSD+2'] }] },
    { id: '0009', client_name: 'Fernando Santos', order_date: '2025-05-20', total_value: 1500.00, status: 'delivered', shipping_date: '2025-05-23', cancellation_date: null, items: [{ product_name: 'Notebook Gamer', product_image: 'https://via.placeholder.com/80x80?text=Notebook', quantity: 1, unit_price: 1500.00, total_item_value: 1500.00, product_pictures: ['https://via.placeholder.com/150x150?text=Notebook+1', 'https://via.placeholder.com/150x150?text=Notebook+2', 'https://via.placeholder.com/150x150?text=Notebook+3'] }] },
    { id: '0010', client_name: 'Gabriela Lima', order_date: '2025-05-15', total_value: 50.00, status: 'canceled', shipping_date: null, cancellation_date: '2025-05-16', items: [{ product_name: 'Cabo HDMI', product_image: 'https://via.placeholder.com/80x80?text=Cabo', quantity: 2, unit_price: 25.00, total_item_value: 50.00, product_pictures: ['https://via.placeholder.com/150x150?text=Cabo+1'] }] },
];

let currentPage = 1;
const ordersPerPage = 5; // Defina quantos pedidos por página
let filteredOrders = [];

// Função para formatar a data (opcional, se precisar de um formato diferente)
function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return new Date(dateString).toLocaleDateString('pt-BR', options);
}

// Função para obter o texto e a classe do badge de status
function getStatusDisplay(status) {
    switch (status) {
        case 'novo': return { text: 'Novo', class: 'order-item__status-badge--shipped' };
        case 'enviado': return { text: 'Enviado', class: 'order-item__status-badge--delivered' };
        case 'cancelado': return { text: 'Cancelado', class: 'order-item__status-badge--canceled' };
        default: return { text: status, class: '' };
    }
}

// Renderiza a lista de pedidos (Mestre)
function renderOrdersList(ordersToDisplay) {
    const $ordersList = $('.admin-orders__list-body');
    $ordersList.empty();

    if (ordersToDisplay.length === 0) {
        $ordersList.append('<p class="admin-orders__list-empty-message">Nenhum pedido encontrado com os critérios de busca.</p>');
        $('#prevPage').prop('disabled', true);
        $('#nextPage').prop('disabled', true);
        $('#pageInfo').text('Página 0 de 0');
        return;
    }

    ordersToDisplay.forEach(order => {
        const statusInfo = getStatusDisplay(order.status);
        const orderHtml = `
            <div class="order-item" data-order-id="${order.id}">
                <span class="order-item__id">${order.id}</span>
                <span class="order-item__client">${order.client_name}</span>
                <span class="order-item__date">${formatDate(order.order_date)}</span>
                <span class="order-item__total-value">R$ ${order.total_value.toFixed(2).replace('.', ',')}</span>
                <span class="order-item__status"><span class="${statusInfo.class}">${statusInfo.text}</span></span>
                <button class="order-item__details-button button button--primary">Detalhes</button>
            </div>
        `;
        $ordersList.append(orderHtml);
    });

    updatePaginationControls();
}

// Atualiza os controles de paginação
function updatePaginationControls() {
    const totalPages = Math.ceil(filteredOrders.length / ordersPerPage);
    $('#pageInfo').text(`Página ${currentPage} de ${totalPages}`);
    $('#prevPage').prop('disabled', currentPage === 1);
    $('#nextPage').prop('disabled', currentPage === totalPages || totalPages === 0);
}

// Filtra e exibe os pedidos para a página atual
function loadOrdersForPage(page) {
    const startIndex = (page - 1) * ordersPerPage;
    const endIndex = startIndex + ordersPerPage;
    const ordersToDisplay = filteredOrders.slice(startIndex, endIndex);
    renderOrdersList(ordersToDisplay);
}

// Carrega os detalhes de um pedido específico (Detalhe)
function loadOrderDetails(orderId) {
    const order = allOrders.find(o => o.id === orderId);
    if (!order) {
        console.error('Pedido não encontrado:', orderId);
        return;
    }

    // Preenche informações do cabeçalho do detalhe
    $('#detailOrderNumber').text(order.id);
    $('#detailClientName').text(order.client_name);
    $('#detailOrderDate').text(formatDate(order.order_date));
    $('#detailTotalValue').text(`R$ ${order.total_value.toFixed(2).replace('.', ',')}`);
    $('#detailOrderStatus').text(getStatusDisplay(order.status).text);

    // Define o status atual no select e gerencia campos de data
    $('#newStatus').val(order.status);
    $('#shippingDate').val(order.shipping_date || '');
    $('#cancellationDate').val(order.cancellation_date || '');
    toggleDateFields(order.status);

    // Carrega itens do pedido
    const $orderItemsList = $('#orderItemsList');
    $orderItemsList.empty();
    order.items.forEach(item => {
        const itemHtml = `
            <div class="order-item-detail">
                <img src="${item.product_image}" alt="${item.product_name}" class="order-item-detail__image">
                <div class="order-item-detail__info">
                    <h4 class="order-item-detail__name">${item.product_name}</h4>
                    <div class="order-item-detail__price-quantity">
                        <p class="order-item-detail__details">Quantidade: ${item.quantity}</p>
                        <p class="order-item-detail__details">Valor Unitário: R$ ${item.unit_price.toFixed(2).replace('.', ',')}</p>
                        <p class="order-item-detail__details">Total: R$ ${item.total_item_value.toFixed(2).replace('.', ',')}</p>
                    </div>
                </div>
            </div>
        `;
        $orderItemsList.append(itemHtml);
    });

    // Carrega fotos dos produtos para o carrossel
    const $productImageCarousel = $('#productImageCarousel');
    $productImageCarousel.empty();
    let allProductImages = [];
    order.items.forEach(item => {
        allProductImages = allProductImages.concat(item.product_pictures);
    });

    if (allProductImages.length > 0) {
        allProductImages.forEach(imagePath => {
            $productImageCarousel.append(`
                <div class="admin-orders__carousel-item products_pics-embla__drag__item">
                    <img src="${imagePath}" alt="Foto do Produto">
                </div>
            `);
        });
        // Reinicializa o carrossel (se estiver usando uma biblioteca como Embla)
        // Se Embla Carousel estiver disponível globalmente (ex: via CDN ou importado)
        // new EmblaCarousel($productImageCarousel[0], { loop: true });
        // Para esta demonstração, usaremos um controle manual simples.
        setupSimpleCarousel($productImageCarousel);
    } else {
        $productImageCarousel.append('<p style="text-align: center; width: 100%; color: var(--medium-grey);">Nenhuma imagem disponível para este pedido.</p>');
        $('.admin-orders__carousel-prev, .admin-orders__carousel-next').hide(); // Esconde botões se não houver imagens
    }


    $('#orderDetails').removeClass('admin-orders__details--hidden');
    $('html, body').animate({
        scrollTop: $('#orderDetails').offset().top - 20 // Rola para a seção de detalhes
    }, 500);
}

// Alterna a visibilidade dos campos de data de envio/cancelamento
function toggleDateFields(status) {
    $('#shippingDateGroup').hide();
    $('#cancellationDateGroup').hide();

    if (status === 'enviado') {
        $('#shippingDateGroup').show();
    } else if (status === 'cancelado') {
        $('#cancellationDateGroup').show();
    }
}

// Função de carrossel simples (apenas para demonstração)
function setupSimpleCarousel($carouselTrack) {
    const $carouselContainer = $carouselTrack.closest('.admin-orders__carousel');
    const $prevButton = $carouselContainer.find('.admin-orders__carousel-prev');
    const $nextButton = $carouselContainer.find('.admin-orders__carousel-next');
    const itemWidth = $carouselTrack.find('.admin-orders__carousel-item').outerWidth(true); // Inclui margem
    let currentScroll = 0;

    if ($carouselTrack.children().length <= 1) { // Menos de 2 itens, não precisa de navegação
        $prevButton.hide();
        $nextButton.hide();
        return;
    } else {
        $prevButton.show();
        $nextButton.show();
    }

    $prevButton.off('click').on('click', function() {
        currentScroll = Math.max(0, currentScroll - itemWidth);
        $carouselTrack.css('transform', `translateX(-${currentScroll}px)`);
    });

    $nextButton.off('click').on('click', function() {
        const maxScroll = $carouselTrack[0].scrollWidth - $carouselTrack.width();
        currentScroll = Math.min(maxScroll, currentScroll + itemWidth);
        $carouselTrack.css('transform', `translateX(-${currentScroll}px)`);
    });

    // Reset scroll position when new images are loaded
    $carouselTrack.css('transform', 'translateX(0px)');
    currentScroll = 0;
}


$(document).ready(function() {
    // Inicializa a lista de pedidos com todos os pedidos
    filteredOrders = [...allOrders];
    loadOrdersForPage(currentPage);

    // Evento de click para o botão de busca
    $('#searchButton').on('click', function() {
        const searchTerm = $('#orderSearchInput').val().toLowerCase();
        filteredOrders = allOrders.filter(order =>
            order.id.toLowerCase().includes(searchTerm) ||
            order.client_name.toLowerCase().includes(searchTerm)
        );
        currentPage = 1; // Volta para a primeira página após a busca
        loadOrdersForPage(currentPage);
        $('#orderDetails').addClass('admin-orders__details--hidden'); // Esconde detalhes ao fazer nova busca
    });

    // Evento para navegar para a página anterior
    $('#prevPage').on('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadOrdersForPage(currentPage);
        }
    });

    // Evento para navegar para a próxima página
    $('#nextPage').on('click', function() {
        const totalPages = Math.ceil(filteredOrders.length / ordersPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadOrdersForPage(currentPage);
        }
    });

    // Evento de click para visualizar detalhes do pedido (delegação de evento)
    $('.admin-orders__list-body').on('click', '.order-item__details-button', function() {
        const orderId = $(this).closest('.order-item').data('order-id');
        loadOrderDetails(orderId);
    });

    // Evento de click no item mestre para visualizar detalhes (para responsividade)
    $('.admin-orders__list-body').on('click', '.order-item', function(event) {
        // Se o click foi no botão, já é tratado acima. Evita click duplo.
        if (!$(event.target).is('.order-item__details-button')) {
            const orderId = $(this).data('order-id');
            loadOrderDetails(orderId);
        }
    });


    // Evento de click para fechar a seção de detalhes
    $('#closeDetails').on('click', function() {
        $('#orderDetails').addClass('admin-orders__details--hidden');
    });

    // Evento de mudança no select de status
    $('#newStatus').on('change', function() {
        const selectedStatus = $(this).val();
        toggleDateFields(selectedStatus);
    });

    // Evento para o botão de atualizar status (apenas simulação)
    $('#updateStatusButton').on('click', function() {
        const orderId = $('#detailOrderNumber').text();
        const newStatus = $('#newStatus').val();
        const shippingDate = $('#shippingDate').val();
        const cancellationDate = $('#cancellationDate').val();

        // ** Aqui você faria a chamada AJAX para a sua API REST **
        // Exemplo:
        // $.ajax({
        //     url: `/api/orders/${orderId}/status`, // Sua URL da API
        //     method: 'PUT', // Ou POST, dependendo da sua API
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Importante para Laravel
        //     },
        //     data: {
        //         status: newStatus,
        //         shipping_date: shippingDate,
        //         cancellation_date: cancellationDate
        //     },
        //     success: function(response) {
        //         alert('Status atualizado com sucesso!');
        //         // Atualizar a ordem na lista allOrders e recarregar a lista
        //         const updatedOrderIndex = allOrders.findIndex(o => o.id === orderId);
        //         if (updatedOrderIndex !== -1) {
        //             allOrders[updatedOrderIndex].status = newStatus;
        //             allOrders[updatedOrderIndex].shipping_date = shippingDate || null;
        //             allOrders[updatedOrderIndex].cancellation_date = cancellationDate || null;
        //             // Recarregar a lista para refletir a mudança
        //             $('#searchButton').trigger('click'); // Simula uma nova busca para atualizar a lista
        //             loadOrderDetails(orderId); // Recarrega os detalhes para mostrar a mudança
        //         }
        //     },
        //     error: function(xhr, status, error) {
        //         alert('Erro ao atualizar status: ' + xhr.responseText);
        //     }
        // });

        // Simulação de atualização de status no frontend apenas
        const updatedOrderIndex = allOrders.findIndex(o => o.id === orderId);
        if (updatedOrderIndex !== -1) {
            allOrders[updatedOrderIndex].status = newStatus;
            allOrders[updatedOrderIndex].shipping_date = shippingDate || null;
            allOrders[updatedOrderIndex].cancellation_date = cancellationDate || null;
            alert(`Status do pedido ${orderId} atualizado para "${getStatusDisplay(newStatus).text}" (simulado)!`);
            $('#searchButton').trigger('click'); // Recarrega a lista para refletir a mudança
            loadOrderDetails(orderId); // Recarrega os detalhes para mostrar a mudança
        }
    });

    // Esconde os campos de data de envio/cancelamento ao iniciar
    toggleDateFields($('#newStatus').val());
});
