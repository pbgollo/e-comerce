import OrderService from "../services/orderService.js";

async function loadOrders(searchTerm = "") {
    const token = localStorage.getItem("token");
    if (!token) {
        console.error("No token found. User not authenticated.");
        document.getElementById("ordersList").innerHTML =
            '<p class="admin-orders__list-empty-message">Por favor, faça login para ver os pedidos.</p>';
        return;
    }

    const filters = {};
    if (searchTerm) {
        if (!isNaN(searchTerm) && !isNaN(parseFloat(searchTerm))) {
            filters.numero = searchTerm;
        } else {
            filters.cliente = searchTerm;
        }
    }

    try {
        const response = await OrderService.getOrders(token, filters);
        if (
            response.success &&
            response.pedidos &&
            response.pedidos.length > 0
        ) {
            renderOrderList(response.pedidos);
        } else {
            document.getElementById("ordersList").innerHTML =
                '<p class="admin-orders__list-empty-message">Nenhum pedido encontrado.</p>';
        }
    } catch (error) {
        console.error("Erro ao carregar pedidos:", error);
        document.getElementById("ordersList").innerHTML =
            '<p class="admin-orders__list-empty-message">Ocorreu um erro ao carregar os pedidos.</p>';
    }
}

function renderOrderList(orders) {
    const container = document.getElementById("ordersList");
    container.innerHTML = "";

    orders.forEach((order) => {
        const total = order.itens.reduce((sum, item) => {
            const price = item.price || (item.product?.stock?.price ?? 0);
            return sum + price * item.quantity;
        }, 0);

        const orderDetailsHtml = generateOrderDetailsHtml(order);

        const row = document.createElement("div");
        row.className =
            "admin-orders__list-row admin-orders__list-row--expanded";
        row.innerHTML = `
            <div class="admin-orders__list-summary">
                <p class="admin-orders__list-item">${order.id}</p>
                <p class="admin-orders__list-item">${
                    order.user.name ?? "Desconhecido"
                }</p>
                <p class="admin-orders__list-item">${formatDate(
                    order.data_pedido
                )}</p>
                <p class="admin-orders__list-item">R$ ${total
                    .toFixed(2)
                    .replace(".", ",")}</p>
                <p class="admin-orders__list-item">${order.situacao}</p>
            </div>
            <div class="admin-orders__details-inline">
                ${orderDetailsHtml}
            </div>
        `;
        container.appendChild(row);
    });
}

function generateOrderDetailsHtml(order) {
    let itemsHtml =
        '<h3 class="admin-orders__items-title">Itens do Pedido</h3>';
    itemsHtml += '<div class="admin-orders__items-list">';
    order.itens.forEach((item) => {
        const product = item.product;
        const price = item.price || product?.stock?.price || 0;
        const totalItem = price * item.quantity;
        itemsHtml += `
            <div class="admin-orders__item">
                <p><strong>Produto:</strong> ${
                    product?.name ?? "Produto Desconhecido"
                }</p>
                <p><strong>Quantidade:</strong> ${item.quantity}</p>
                <p><strong>Valor Unitário:</strong> R$ ${price
                    .toFixed(2)
                    .replace(".", ",")}</p>
                <p><strong>Valor Total:</strong> R$ ${totalItem
                    .toFixed(2)
                    .replace(".", ",")}</p>
            </div>
        `;
    });
    itemsHtml += "</div>";

    let imagesHtml =
        '<h3 class="admin-orders__carousel-title">Fotos dos Produtos no Pedido</h3>';
    imagesHtml += '<div class="admin-orders__carousel products_pics-embla">';
    imagesHtml +=
        '<div class="admin-orders__carousel-drag products_pics-embla__drag">';
    order.itens.forEach((item) => {
        const product = item.product;
        if (product && product.image) {
            imagesHtml += `
        <div class="products_pics-embla__slide">
            <img src="/storage/${product.image}" alt="${
                product.image_alt ?? product.name
            }">
        </div>
    `;
        }
    });
    imagesHtml += "</div>";
    imagesHtml += `
        <button class="admin-orders__carousel-prev products_pics-embla-prev">
            <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                    fill="#565C69"></path>
            </svg>
        </button>
        <button class="admin-orders__carousel-next products_pics-embla-next">
            <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                    fill="#565C69"></path>
            </svg>
        </button>
    </div>`;

    let statusUpdateHtml = `
        <div class="admin-orders__status-update">
            <h3 class="admin-orders__status-update-title">Atualizar Status do Pedido</h3>
            <div class="form-group admin-orders__form-group">
                <label for="newStatus-${
                    order.id
                }" class="admin-orders__form-label">Novo Status:</label>
                <select id="newStatus-${
                    order.id
                }" class="admin-orders__form-select" onchange="handleStatusChange(this, ${
        order.id
    })">
                    <option value="novo" ${
                        order.situacao === "novo" ? "selected" : ""
                    }>Novo</option>
                    <option value="enviado" ${
                        order.situacao === "enviado" ? "selected" : ""
                    }>Enviado</option>
                    <option value="cancelado" ${
                        order.situacao === "cancelado" ? "selected" : ""
                    }>Cancelado</option>
                </select>
            </div>
            <div class="form-group admin-orders__form-group" id="shippingDateGroup-${
                order.id
            }" style="display:none;">
                <label for="shippingDate-${
                    order.id
                }" class="admin-orders__form-label">Data de Envio:</label>
                <input type="date" id="shippingDate-${
                    order.id
                }" class="admin-orders__form-input">
            </div>
            <div class="form-group admin-orders__form-group" id="cancellationDateGroup-${
                order.id
            }" style="display:none;">
                <label for="cancellationDate-${
                    order.id
                }" class="admin-orders__form-label">Data de Cancelamento:</label>
                <input type="date" id="cancellationDate-${
                    order.id
                }" class="admin-orders__form-input">
            </div>
            <button class="admin-orders__status-update-button button button--primary" onclick="updateStatus(${
                order.id
            })">Atualizar Status</button>
        </div>
    `;

    return `
        ${statusUpdateHtml}
        ${itemsHtml}
        ${imagesHtml}
    `;
}

window.handleStatusChange = function (selectElement, orderId) {
    const newStatus = selectElement.value;
    const shippingDateGroup = document.getElementById(
        `shippingDateGroup-${orderId}`
    );
    const cancellationDateGroup = document.getElementById(
        `cancellationDateGroup-${orderId}`
    );

    if (shippingDateGroup) shippingDateGroup.style.display = "none";
    if (cancellationDateGroup) cancellationDateGroup.style.display = "none";

    if (newStatus === "enviado") {
        if (shippingDateGroup) shippingDateGroup.style.display = "block";
    } else if (newStatus === "cancelado") {
        if (cancellationDateGroup)
            cancellationDateGroup.style.display = "block";
    }
};

window.updateStatus = async function (orderId) {
    const newStatusSelect = document.getElementById(`newStatus-${orderId}`);
    const newStatus = newStatusSelect.value;
    const shippingDate = document.getElementById(
        `shippingDate-${orderId}`
    )?.value;
    const cancellationDate = document.getElementById(
        `cancellationDate-${orderId}`
    )?.value;
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
            loadOrders();
        } else {
            alert(
                `Erro ao atualizar status: ${
                    response.message || "Erro desconhecido"
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

document.addEventListener("DOMContentLoaded", () => {
    loadOrders();

    document.getElementById("searchButton").addEventListener("click", () => {
        const searchTerm = document
            .getElementById("orderSearchInput")
            .value.trim();
        loadOrders(searchTerm);
    });

    document.getElementById("prevPage").addEventListener("click", () => {});
    document.getElementById("nextPage").addEventListener("click", () => {});
});
