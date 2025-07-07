import AppUserService from "../services/appUserService.js";
import OrderService from "../services/orderService.js";
import ProductService from "../services/productService.js";
import CartManager from "../services/cartManager.js";

let currentStep = "cart"; // "cart" or "payment"
let cartItemsDetailed = [];

function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

async function loadCartDetails() {
    const simpleCartItems = CartManager.getCartItems();
    console.log("Carrinho simples:", simpleCartItems);

    if (simpleCartItems.length === 0) {
        cartItemsDetailed = [];
        return;
    }

    const productIds = simpleCartItems.map((item) => item.product_id);

    try {
        const productsData = await ProductService.getProductsByIds(productIds);

        cartItemsDetailed = simpleCartItems
            .map((cartItem) => {
                const fullProductData = productsData.find(
                    (p) => p.id === cartItem.product_id
                );
                if (fullProductData) {
                    return {
                        product: fullProductData,
                        quantity: cartItem.quantity,
                    };
                }
                console.warn(
                    `Produto com ID ${cartItem.product_id} não encontrado na API.`
                );
                return null;
            })
            .filter((item) => item !== null);
    } catch (error) {
        console.error("Erro ao carregar detalhes do carrinho:", error);
        alert(
            "Não foi possível carregar os detalhes do seu carrinho. Por favor, tente novamente."
        );
        cartItemsDetailed = [];
    }
}

function calculateCartTotals() {
    let subtotal = 0;
    cartItemsDetailed.forEach((item) => {
        if (item.product && item.product.stock) {
            const price =
                item.product.stock.promotion_active == 1
                    ? item.product.stock.promotion_price ||
                      item.product.stock.price
                    : item.product.stock.price;
            subtotal += price * item.quantity;
        }
    });

    const pixPrice = subtotal * 0.85; // Assumindo 15% de desconto no PIX
    const economy = subtotal - pixPrice;
    const installments = 8; // Assumindo 8 parcelas fixas
    const installmentValue = subtotal / installments;

    return { subtotal, pixPrice, economy, installments, installmentValue };
}

// --- Render Functions ---

async function updateCartDisplay() {
    await loadCartDetails(); // Garante que cartItemsDetailed está atualizado

    const cartItemsList = document.getElementById("cartItemsList");
    const emptyCartMessage = document.getElementById("emptyCartMessage");
    const goToPaymentButton = document.getElementById("goToPaymentButton");

    const { subtotal, pixPrice, economy, installments, installmentValue } =
        calculateCartTotals();

    // Limpa os itens existentes ANTES de adicionar os novos
    cartItemsList.innerHTML = '';

    // Remove listeners antigos antes de potencialmente adicionar novos
    // Isso evita duplicação de eventos.
    document.querySelectorAll(".quantity-select").forEach((select) => {
        select.removeEventListener("change", handleQuantityChange);
    });
    document.querySelectorAll(".remove-item-button").forEach((button) => {
        button.removeEventListener("click", handleRemoveItem);
    });

        if (cartItemsDetailed.length === 0) {
            console.log("Carrinho vazio, renderizando mensagem de carrinho vazio.");
            console.log(emptyCartMessage);
            if (emptyCartMessage) emptyCartMessage.classList.remove("hidden");
            if (goToPaymentButton) goToPaymentButton.disabled = true;
            cartItemsList.innerHTML = '';
        } else {
            if (emptyCartMessage) emptyCartMessage.classList.add("hidden");
            if (goToPaymentButton) goToPaymentButton.disabled = false;
            cartItemsList.innerHTML = '';

        cartItemsDetailed.forEach((item) => {
            const product = item.product;
            if (!product || !product.stock) return;

            const price =
                product.stock.promotion_active == 1
                    ? product.stock.promotion_price || product.stock.price
                    : product.stock.price;
            const displayPixPrice = price * 0.85;

            const maxQuantityOptions = Math.min(product.stock.quantity, 5); // Limita a 5 ou ao estoque

            const itemHtml = `
                <div class="order-item">
                    <div class="order-item-image">
                        <img src="/storage/${
                            product.image
                        }" alt="${product.image_alt || product.name}">
                    </div>
                    <div class="order-item-info">
                        <p class="order-item-supplier">Vendido e entregue por: <span>${
                            product.supplier ? product.supplier.name : "N/A"
                        }</span></p>
                        <p class="order-item-name">${
                            product.name
                        }</p>
                        <p class="order-item-price-pix">Com desconto no PIX: <span>${formatCurrency(
                            displayPixPrice
                        )}</span></p>
                        <p class="order-item-price-installments">Parcela de cartão sem juros: <span>${formatCurrency(
                            price
                        )}</span></p>
                    </div>
                    <div class="order-item-actions">
                        <select data-product-id="${
                            product.id
                        }" class="quantity-select">
                            ${Array.from(
                                { length: maxQuantityOptions },
                                (_, i) => i + 1
                            )
                                .map(
                                    (qty) => `
                                <option value="${qty}" ${
                                        item.quantity === qty ? "selected" : ""
                                    }>${qty}</option>
                                `
                                )
                                .join("")}
                        </select>
                        <button data-product-id="${
                            product.id
                        }" class="remove-item-button">REMOVER</button>
                    </div>
                </div>
            `;
            cartItemsList.insertAdjacentHTML('beforeend', itemHtml);
        });
    }

    // Update summary values
    document.getElementById("summarySubtotal").textContent = formatCurrency(subtotal);
    document.getElementById("summaryTotalInstallments").textContent = formatCurrency(subtotal);
    document.getElementById("summaryInstallmentDetails").textContent = `(em até ${installments}x de ${formatCurrency(installmentValue)} sem juros)`;
    document.getElementById("summaryPixPrice").textContent = formatCurrency(pixPrice);
    document.getElementById("summaryEconomy").textContent = `(Economize ${formatCurrency(economy)})`;

    // Re-attach event listeners after DOM update
    // Agora, os listeners são adicionados apenas uma vez por elemento.
    document.querySelectorAll(".quantity-select").forEach((select) => {
        select.addEventListener("change", handleQuantityChange);
    });
    document.querySelectorAll(".remove-item-button").forEach((button) => {
        button.addEventListener("click", handleRemoveItem);
    });
}

function updatePaymentDisplay() {
    const { subtotal, pixPrice, economy } = calculateCartTotals();

    document.getElementById("paymentSubtotal").textContent = formatCurrency(subtotal);
    document.getElementById("paymentPixPrice").textContent = formatCurrency(pixPrice);
    document.getElementById("paymentEconomy").textContent = `(Economize ${formatCurrency(economy)})`;

    // Não é necessário re-anexar listeners aqui, pois os botões desta tela são estáticos.
    // attachPaymentEventListeners(); // Removido para evitar redundância, pois já é chamado no DOMContentLoaded
}

function showCartPage() {
    currentStep = "cart";
    document.getElementById("cartPageSection").classList.remove("hidden");
    document.getElementById("paymentPageSection").classList.add("hidden");
    document.getElementById("cartStepLink").classList.add("checkout-step-item--active");
    document.getElementById("paymentStepLink").classList.remove("checkout-step-item--active");
    updateCartDisplay(); // Chamada para re-renderizar o carrinho
}

function showPaymentPage() {
    currentStep = "payment";
    document.getElementById("cartPageSection").classList.add("hidden");
    document.getElementById("paymentPageSection").classList.remove("hidden");
    document.getElementById("cartStepLink").classList.remove("checkout-step-item--active");
    document.getElementById("paymentStepLink").classList.add("checkout-step-item--active");
    updatePaymentDisplay();
}


// --- Event Listeners ---

// Função auxiliar para inicializar listeners que não mudam frequentemente
function initializeStaticListeners() {
    // Listeners do cabeçalho
    document.getElementById("cartStepLink")?.addEventListener("click", showCartPage);
    document.getElementById("paymentStepLink")?.addEventListener("click", showPaymentPage);

    // Listeners da página de carrinho
    document.getElementById("goToPaymentButton")?.addEventListener("click", () => {
        if (cartItemsDetailed.length === 0) {
            alert("Seu carrinho está vazio. Adicione itens antes de prosseguir para o pagamento.");
            return;
        }
        showPaymentPage();
    });

    // Listeners da página de pagamento
    document.getElementById("createOrderButton")?.addEventListener("click", handleCreateOrder);
    document.getElementById("backToCartButton")?.addEventListener("click", showCartPage);
}


async function handleQuantityChange(event) {
    const productId = parseInt(event.target.dataset.productId);
    const newQuantity = parseInt(event.target.value);

    CartManager.updateItemQuantity(productId, newQuantity);
    await updateCartDisplay(); // Re-renderiza o carrinho
}

async function handleRemoveItem(event) {
    const productId = parseInt(event.target.dataset.productId);

    CartManager.removeItem(productId);
    await updateCartDisplay(); // Re-renderiza o carrinho
}


// --- Checkout Logic ---

async function handleCreateOrder() {
    const token = localStorage.getItem("token"); // Assuming token is stored in localStorage
    if (!token) {
        alert(
            "Autenticação necessária para criar o pedido. Por favor, faça login."
        );
        return;
    }

    const selectedPaymentMethod = document.querySelector(
        'input[name="payment_method"]:checked'
    )?.value;
    const isPix = selectedPaymentMethod === "pix";

    const itemsPayload = cartItemsDetailed.map((item) => ({
        product_id: item.product.id,
        quantity: item.quantity,
    }));

    if (itemsPayload.length === 0) {
        alert(
            "Seu carrinho está vazio. Adicione itens antes de criar um pedido."
        );
        return;
    }

    const createOrderBtn = document.getElementById("createOrderButton");
    if (createOrderBtn) {
        createOrderBtn.disabled = true;
        createOrderBtn.textContent = "Criando Pedido...";
    }

    try {
        const response = await OrderService.createOrder(
            itemsPayload,
            isPix,
            token // Passando o token aqui
        );
        if (response.success) {
            alert(
                `Pedido ${
                    response.order_id
                } criado com sucesso! Total: ${formatCurrency(response.total)}`
            );
            CartManager.clearCart();
            cartItemsDetailed = [];

            window.location.href = "/admin/pedidos";
        } else {
            const errorMessage =
                response.message || "Erro desconhecido ao criar pedido.";
            alert(`Erro ao criar pedido: ${errorMessage}`);
        }
    } catch (error) {
        console.error("Erro ao criar pedido:", error);
        let errorMessage =
            "Ocorreu um erro ao criar o pedido. Tente novamente mais tarde.";
        if (
            error.response &&
            error.response.data &&
            error.response.data.message
        ) {
            errorMessage = error.response.data.message;
        } else if (error.message) {
            errorMessage = error.message;
        }
        alert(`Erro: ${errorMessage}`);
    } finally {
        if (createOrderBtn) {
            createOrderBtn.disabled = false;
            createOrderBtn.textContent = "CRIAR PEDIDO";
        }
    }
}

// --- Initial Load ---
document.addEventListener("DOMContentLoaded", async () => {
    initializeStaticListeners(); // Anexa listeners que não mudam apenas uma vez

    // Initial display based on currentStep (defaulting to cart)
    if (currentStep === "cart") {
        showCartPage();
    } else {
        showPaymentPage();
    }
});
