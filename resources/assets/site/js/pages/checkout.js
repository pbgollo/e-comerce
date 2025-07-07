import AppUserService from "../services/appUserService.js";
import OrderService from "../services/orderService.js";
import ProductService from "../services/productService.js";
import CartManager from "../services/cartManager.js";

let currentStep = "cart";
let cartItemsDetailed = [];

function formatCurrency(value) {
    return `R$ ${value.toFixed(2).replace(".", ",")}`;
}

async function loadCartDetails() {
    const simpleCartItems = CartManager.getCartItems();

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

    const pixPrice = subtotal * 0.85;
    const economy = subtotal - pixPrice;
    const installments = 8;
    const installmentValue = subtotal / installments;

    return { subtotal, pixPrice, economy, installments, installmentValue };
}

// --- Render Functions ---

async function renderCartPage() {
    await loadCartDetails();

    const container = document.getElementById("checkoutContainer");
    const { subtotal, pixPrice, economy, installments, installmentValue } =
        calculateCartTotals();

    let cartItemsHtml = "";
    if (cartItemsDetailed.length === 0) {
        cartItemsHtml =
            '<p class="text-center text-gray-600">Seu carrinho está vazio.</p>';
    } else {
        cartItemsDetailed.forEach((item) => {
            const product = item.product;
            if (!product || !product.stock) return;

            const price =
                product.stock.promotion_active == 1
                    ? product.stock.promotion_price || product.stock.price
                    : product.stock.price;
            const displayPixPrice = price * 0.85;

            const maxQuantityOptions = Math.min(product.stock.quantity, 5); // Limita a 5 ou ao estoque

            cartItemsHtml += `
                <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-b-0">
                    <div class="flex-shrink-0">
                        <img class="w-24 h-24 object-cover rounded-lg" src="/storage/${
                            product.image
                        }" alt="${product.image_alt || product.name}">
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm text-gray-500">Vendido e entregue por: <span class="font-medium text-gray-700">${
                            product.supplier ? product.supplier.name : "N/A"
                        }</span></p>
                        <p class="text-lg font-semibold text-gray-900">${
                            product.name
                        }</p>
                        <p class="text-sm text-gray-700 mt-1">Com desconto no PIX: <span class="font-bold text-green-600">${formatCurrency(
                            displayPixPrice
                        )}</span></p>
                        <p class="text-sm text-gray-700">Parcela de cartão sem juros: <span class="font-bold">${formatCurrency(
                            price
                        )}</span></p>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <select data-product-id="${
                            product.id
                        }" class="quantity-select border border-gray-300 rounded-md py-1 px-2 text-sm focus:ring-blue-500 focus:border-blue-500">
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
                        }" class="remove-item-button text-red-600 hover:text-red-800 text-sm font-medium">REMOVER</button>
                    </div>
                </div>
            `;
        });
    }

    container.innerHTML = `
        <header class="mb-6">
            <nav class="flex justify-center space-x-4 text-gray-500 text-lg font-medium">
                <a class="cart-steps__item ${
                    currentStep === "cart" ? "cart-steps__item--active" : ""
                }">Carrinho</a>
                <a class="cart-steps__item ${
                    currentStep === "payment" ? "cart-steps__item--active" : ""
                }">Pagamento</a>
                <a class="cart-steps__item">Confirmação</a>
            </nav>
        </header>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Seu Carrinho</h2>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                    ${cartItemsHtml}
                </div>
            </div>

            <aside class="w-full lg:w-80 bg-gray-50 p-6 rounded-lg shadow-inner flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">RESUMO</h2>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <p class="text-gray-700">Valor dos Produtos:</p>
                        <p class="font-semibold text-gray-900">${formatCurrency(
                            subtotal
                        )}</p>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <p class="text-gray-700">Frete:</p>
                        <p class="font-semibold text-gray-900">R$ 0,00</p>
                    </div>
                    <div class="py-2 border-b border-gray-200">
                        <p class="text-gray-700 font-bold">Total a prazo:</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">${formatCurrency(
                            subtotal
                        )}</p>
                        <p class="text-sm text-gray-500">(em até ${installments}x de ${formatCurrency(
        installmentValue
    )} sem juros)</p>
                    </div>
                    <div class="py-2">
                        <p class="text-gray-700 font-bold">Valor à vista no PIX:</p>
                        <p class="text-xl font-bold text-green-600 mt-1">${formatCurrency(
                            pixPrice
                        )}</p>
                        <p class="text-sm text-green-500">(Economize ${formatCurrency(
                            economy
                        )})</p>
                    </div>
                </div>
                <div class="mt-6 space-y-3">
                    <button id="goToPaymentButton" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition-colors shadow-md">IR PARA PAGAMENTO</button>
                    <button onclick= "window.location.href = ''" class="w-full border border-gray-300 text-gray-700 font-semibold py-3 rounded-md hover:bg-gray-200 transition-colors">CONTINUAR COMPRANDO</button>
                </div>
            </aside>
        </div>
    `;
    attachCartEventListeners();
}

function renderPaymentPage() {
    const container = document.getElementById("checkoutContainer");
    const { subtotal, pixPrice, economy } = calculateCartTotals();

    container.innerHTML = `
        <header class="mb-6">
            <nav class="flex justify-center space-x-4 text-gray-500 text-lg font-medium">
                <a class="cart-steps__item ${
                    currentStep === "cart" ? "cart-steps__item--active" : ""
                }">Carrinho</a>
                <a class="cart-steps__item ${
                    currentStep === "payment" ? "cart-steps__item--active" : ""
                }">Pagamento</a>
                <a class="cart-steps__item">Confirmação</a>
            </nav>
        </header>

        <div class="flex flex-col lg:flex-row gap-8">
            <main class="flex-1 bg-gray-50 p-6 rounded-lg shadow-inner">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">FORMA DE PAGAMENTO</h2>

                <div class="space-y-4">
                    <div class="border border-gray-300 rounded-lg p-4 flex items-center cursor-pointer hover:bg-gray-100 transition-colors">
                        <label class="flex items-center w-full">
                            <input type="radio" name="payment_method" value="pix" class="form-radio h-5 w-5 text-blue-600" checked>
                            <span class="ml-3 text-lg font-medium text-gray-800">PIX</span>
                            <span class="payment-option__icon payment-option__icon--pix"></span>
                        </label>
                        <div class="ml-8 text-sm text-gray-600">
                            <p>Até 15% de desconto com aprovação imediata que torna a expedição mais rápida do pedido.</p>
                        </div>
                    </div>

                    <div class="border border-gray-300 rounded-lg p-4 flex items-center cursor-pointer hover:bg-gray-100 transition-colors">
                        <label class="flex items-center w-full">
                            <input type="radio" name="payment_method" value="boleto" class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-3 text-lg font-medium text-gray-800">BOLETO BANCÁRIO</span>
                            <span class="payment-option__icon payment-option__icon--barcode"></span>
                        </label>
                    </div>

                    <div class="border border-gray-300 rounded-lg p-4 flex items-center cursor-pointer hover:bg-gray-100 transition-colors">
                        <label class="flex items-center w-full">
                            <input type="radio" name="payment_method" value="credit_card" class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-3 text-lg font-medium text-gray-800">CARTÃO DE CRÉDITO</span>
                            <span class="payment-option__icon payment-option__icon--credit-card"></span>
                        </label>
                    </div>
                </div>
            </main>

            <aside class="w-full lg:w-80 bg-gray-50 p-6 rounded-lg shadow-inner flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">VALOR DA COMPRA</h2>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <p class="text-gray-700">Total da compra:</p>
                        <p class="font-semibold text-gray-900">${formatCurrency(
                            subtotal
                        )}</p>
                    </div>
                    <div class="py-2">
                        <p class="text-gray-700 font-bold">Pagamento via Pix:</p>
                        <p class="text-xl font-bold text-green-600 mt-1">${formatCurrency(
                            pixPrice
                        )}</p>
                        <p class="text-sm text-green-500">(Economize ${formatCurrency(
                            economy
                        )})</p>
                    </div>
                </div>
                <div class="mt-6 space-y-3">
                    <button id="createOrderButton" class="w-full bg-green-600 text-white font-semibold py-3 rounded-md hover:bg-green-700 transition-colors shadow-md">CRIAR PEDIDO</button>
                    <button onclick= "window.location.href = ''" id="backToCartButton" class="w-full border border-gray-300 text-gray-700 font-semibold py-3 rounded-md hover:bg-gray-200 transition-colors">VOLTAR</button>
                </div>
            </aside>
        </div>
    `;
    attachPaymentEventListeners();
}

// --- Event Listeners ---

function attachCartEventListeners() {
    document
        .getElementById("goToPaymentButton")
        ?.addEventListener("click", () => {
            if (cartItemsDetailed.length === 0) {
                alert(
                    "Seu carrinho está vazio. Adicione itens antes de prosseguir para o pagamento."
                );
                return;
            }
            currentStep = "payment";
            renderPaymentPage();
        });

    document.querySelectorAll(".quantity-select").forEach((select) => {
        select.addEventListener("change", async (event) => {
            const productId = parseInt(event.target.dataset.productId);
            const newQuantity = parseInt(event.target.value);

            CartManager.updateItemQuantity(productId, newQuantity);

            await renderCartPage();
        });
    });

    document.querySelectorAll(".remove-item-button").forEach((button) => {
        button.addEventListener("click", async (event) => {
            const productId = parseInt(event.target.dataset.productId);

            CartManager.removeItem(productId);

            await renderCartPage();
        });
    });
}

function attachPaymentEventListeners() {
    document
        .getElementById("createOrderButton")
        ?.addEventListener("click", handleCreateOrder);
    document
        .getElementById("backToCartButton")
        ?.addEventListener("click", async () => {
            currentStep = "cart";
            await renderCartPage();
        });
}

// --- Checkout Logic ---

async function handleCreateOrder() {
    const token = localStorage.getItem("token");
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
        // Passar o token de autenticação para o OrderService se ele precisar
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

            currentStep = "cart";
            await renderCartPage();
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
    await renderCartPage();
});
