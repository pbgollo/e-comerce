import EmblaCarousel from "embla-carousel";
import Autoplay from "embla-carousel-autoplay";
import OrderService from "../services/orderService.js";

let currentPage = 1;
let lastPage = 1;
let searchTermGlobal = "";

const orderRowTemplate = document.getElementById("orderRowTemplate");
const orderDetailsTemplate = document.getElementById("orderDetailsTemplate");
const orderItemTemplate = document.getElementById("orderItemTemplate");
const productImageTemplate = document.getElementById("productImageTemplate");

function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

async function loadOrders(searchTerm = "", page = 1) {
    const token = localStorage.getItem("token");
    if (!token) {
        document.getElementById("ordersList").innerHTML =
            '<p class="admin-orders__list-empty-message">Por favor, faça login para ver os pedidos.</p>';
        return;
    }

    const filters = { page };
    searchTermGlobal = searchTerm;

    if (searchTerm) {
        if (!isNaN(searchTerm) && !isNaN(parseFloat(searchTerm))) {
            filters.numero = searchTerm;
        } else {
            filters.cliente = searchTerm;
        }
    }

    try {
        const response = await OrderService.getOrders(token, filters);
        const data = response.pedidos;

        if (response.success && data.data && data.data.length > 0) {
            renderOrderList(data.data);

            currentPage = data.current_page;
            lastPage = data.last_page;

            updatePaginationUI();

            emblaCarousel();

        } else {
            document.getElementById("ordersList").innerHTML =
                '<p class="admin-orders__list-empty-message">Nenhum pedido encontrado.</p>';
            document.getElementById("pageInfo").innerText = "Página 0 de 0";
            togglePaginationButtons(true, true);
        }
    } catch (error) {
        console.error("Erro ao carregar pedidos:", error);
        document.getElementById("ordersList").innerHTML =
            '<p class="admin-orders__list-empty-message">Ocorreu um erro ao carregar os pedidos.</p>';
    }
}

function updatePaginationUI() {
    document.getElementById("pageInfo").innerText = `Página ${currentPage} de ${lastPage}`;
    togglePaginationButtons(currentPage === 1, currentPage === lastPage);
}

function togglePaginationButtons(prevDisabled, nextDisabled) {
    document.getElementById("prevPage").disabled = prevDisabled;
    document.getElementById("nextPage").disabled = nextDisabled;
}

document.getElementById("prevPage").addEventListener("click", () => {
    if (currentPage > 1) {
        loadOrders(searchTermGlobal, currentPage - 1);
    }
});

document.getElementById("nextPage").addEventListener("click", () => {
    if (currentPage < lastPage) {
        loadOrders(searchTermGlobal, currentPage + 1);
    }
});


function renderOrderList(orders) {
    const container = document.getElementById("ordersList");
    container.innerHTML = "";

    orders.forEach((order) => {
        const row = orderRowTemplate.content.cloneNode(true).firstElementChild;

        row.querySelector('[data-order-id]').textContent = order.id;
        row.querySelector('[data-client-name]').textContent = order.user.name ?? "Desconhecido";
        row.querySelector('[data-order-date]').textContent = getFormattedStatusDate(order);

        const total = order.itens.reduce((sum, item) => {
            const price = item.price || (item.product?.stock?.price ?? 0);
            return sum + price * item.quantity;
        }, 0);
        row.querySelector('[data-total-value]').textContent = formatCurrency(total);
        row.querySelector('[data-order-status]').textContent = order.situacao;
        row.querySelector('[data-order-status]').className = `admin-orders__list-item status ${order.situacao.toLowerCase()}`;

        const detailsContainer = row.querySelector('.admin-orders__details-inline');
        const detailsContent = orderDetailsTemplate.content.cloneNode(true);
        detailsContainer.appendChild(detailsContent);

        const itemsList = detailsContainer.querySelector('[data-items-list]');
        order.itens.forEach(item => {
            const itemElement = orderItemTemplate.content.cloneNode(true).firstElementChild;
            const product = item.product;
            const price = item.price || product?.stock?.price || 0;
            const totalItem = price * item.quantity;

            itemElement.querySelector('[data-product-name]').textContent = product?.name ?? "Produto Desconhecido";
            itemElement.querySelector('[data-item-quantity]').textContent = item.quantity;
            itemElement.querySelector('[data-item-unit-price]').textContent = formatCurrency(price);
            itemElement.querySelector('[data-item-total-price]').textContent = formatCurrency(totalItem);
            itemsList.appendChild(itemElement);
        });

        const imagesCarousel = detailsContainer.querySelector('[data-product-images-carousel]');
        order.itens.forEach(item => {
            const product = item.product;
            if (product && product.image) {
                const imageElement = productImageTemplate.content.cloneNode(true).firstElementChild;
                const imgTag = imageElement.querySelector('[data-product-image]');
                imgTag.src = `/storage/${product.image}`;
                imgTag.alt = product.image_alt ?? product.name;
                imagesCarousel.appendChild(imageElement);
            }
        });


        const newStatusSelect = detailsContainer.querySelector('[data-new-status-select]');
        if (newStatusSelect) {
            newStatusSelect.value = order.situacao;

            window.handleStatusChange(newStatusSelect);
        }

        container.appendChild(row);
    });
}

function getFormattedStatusDate(order) {
    switch (order.situacao) {
        case "enviado":
            return `Enviado em ${formatDate(order.data_envio)}`;
        case "cancelado":
            return `Cancelado em ${formatDate(order.data_cancelamento)}`;
        default:
            return `Criado em ${formatDate(order.data_pedido)}`;
    }
}


window.handleStatusChange = function (selectElement) {

    const parentRow = selectElement.closest('.admin-orders__list-row');
    if (!parentRow) return;

    const newStatus = selectElement.value;
    const shippingDateGroup = parentRow.querySelector('[data-shipping-date-group]');
    const cancellationDateGroup = parentRow.querySelector('[data-cancellation-date-group]');

    if (shippingDateGroup) shippingDateGroup.style.display = "none";
    if (cancellationDateGroup) cancellationDateGroup.style.display = "none";

    if (newStatus === "enviado") {
        if (shippingDateGroup) shippingDateGroup.style.display = "block";
    } else if (newStatus === "cancelado") {
        if (cancellationDateGroup)
            cancellationDateGroup.style.display = "block";
    }
};


window.updateStatus = async function (buttonElement) {

    const parentRow = buttonElement.closest('.admin-orders__list-row');
    if (!parentRow) {
        console.error("Não foi possível encontrar a linha do pedido pai para atualização de status.");
        return;
    }


    const orderIdElement = parentRow.querySelector('[data-order-id]');
    if (!orderIdElement) {
        console.error("Não foi possível encontrar o ID do pedido na linha.");
        return;
    }
    const orderId = orderIdElement.textContent;

    const newStatusSelect = parentRow.querySelector('[data-new-status-select]');
    const newStatus = newStatusSelect ? newStatusSelect.value : '';

    const shippingDate = parentRow.querySelector('[data-shipping-date-input]')?.value;
    const cancellationDate = parentRow.querySelector('[data-cancellation-date-input]')?.value;
    const token = localStorage.getItem("token");

    if (!token) {
        alert("Autenticação necessária para atualizar o status.");
        return;
    }

    const updateData = {
        status: newStatus,
    };

    if (newStatus === "enviado") {
        updateData.data_envio = shippingDate;
    } else if (newStatus === "cancelado") {
        updateData.data_cancelamento = cancellationDate;
    }

    try {
        const response = await OrderService.updateOrderStatus(
            orderId,
            updateData,
            token
        );
        if (response.success) {
            alert("Status do pedido atualizado com sucesso!");

            loadOrders(searchTermGlobal, currentPage);
        } else {
            alert(
                `Erro ao atualizar status: ${response.message || "Erro desconhecido"
                }`
            );
        }
    } catch (error) {
        console.error("Erro ao atualizar status do pedido:", error);
        const errorMessage =
            error.response?.data?.message ||
            "Ocorreu um erro ao atualizar o status do pedido.";
        alert(errorMessage);
    }
};

function formatDate(dateStr) {
    if (!dateStr) return "N/A";
    const date = new Date(dateStr);
    return date.toLocaleDateString("pt-BR");
}

function emblaCarousel() {
    const emblaNodes = document.querySelectorAll(".products_pics-embla");

    emblaNodes.forEach((emblaNode) => {
        const prevBtn = emblaNode.querySelector(".admin-orders__carousel-prev");
        const nextBtn = emblaNode.querySelector(".admin-orders__carousel-next");
        const dragContainer = emblaNode.querySelector(".products_pics-embla__drag");

        if (!emblaNode || !prevBtn || !nextBtn || !dragContainer) {
            return;
        }

        const options = {
            loop: false,
            draggable: true,
            containScroll: "trimSnaps",
            slidesToScroll: 1,
            speed: 10,
        };

        const plugins = [Autoplay({ delay: 4000, stopOnInteraction: false })];
        const emblaApi = EmblaCarousel(emblaNode, options, plugins);

        if (prevBtn) {
            prevBtn.addEventListener("click", () => emblaApi.scrollPrev());
        }
        if (nextBtn) {
            nextBtn.addEventListener("click", () => emblaApi.scrollNext());
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    loadOrders();

    document.getElementById("searchButton").addEventListener("click", () => {
        const searchTerm = document
            .getElementById("orderSearchInput")
            .value.trim();
        loadOrders(searchTerm);
    });

    document.getElementById("prevPage").addEventListener("click", () => { });
    document.getElementById("nextPage").addEventListener("click", () => { });
});
