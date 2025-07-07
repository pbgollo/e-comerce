// cartManager.js
const CART_STORAGE_KEY = "cart";

class CartManager {
    /**
     * Carrega os itens do carrinho do localStorage.
     * Retorna um array de { product_id: number, quantity: number }.
     */
    static getCartItems() {
        const storedCart = localStorage.getItem(CART_STORAGE_KEY);
        try {
            return storedCart ? JSON.parse(storedCart) : [];
        } catch (e) {
            console.error("Erro ao parsear o carrinho do localStorage:", e);
            localStorage.removeItem(CART_STORAGE_KEY); // Limpa dados corrompidos
            return [];
        }
    }

    /**
     * Salva os itens do carrinho no localStorage.
     * @param {Array<Object>} cartItems - Array de objetos { product_id, quantity }.
     */
    static saveCartItems(cartItems) {
        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cartItems));
    }

    /**
     * Adiciona um produto ao carrinho ou atualiza sua quantidade.
     * @param {number} productId - ID do produto.
     * @param {number} quantity - Quantidade a adicionar (padrão: 1).
     */
    static addItem(productId, quantity = 1) {
        let cart = CartManager.getCartItems();
        const existingItemIndex = cart.findIndex(
            (item) => item.product_id === productId
        );

        if (existingItemIndex > -1) {
            cart[existingItemIndex].quantity += quantity;
        } else {
            cart.push({ product_id: productId, quantity: quantity });
        }
        CartManager.saveCartItems(cart);
        console.log("Carrinho atualizado:", cart);
        return cart;
    }

    /**
     * Remove um produto do carrinho.
     * @param {number} productId - ID do produto a ser removido.
     */
    static removeItem(productId) {
        let cart = CartManager.getCartItems();
        cart = cart.filter((item) => item.product_id !== productId);
        CartManager.saveCartItems(cart);
        console.log("Item removido. Carrinho atual:", cart);
        return cart;
    }

    /**
     * Atualiza a quantidade de um produto no carrinho.
     * @param {number} productId - ID do produto.
     * @param {number} newQuantity - Nova quantidade.
     */
    static updateItemQuantity(productId, newQuantity) {
        let cart = CartManager.getCartItems();
        const itemIndex = cart.findIndex(
            (item) => item.product_id === productId
        );

        if (itemIndex > -1) {
            if (newQuantity <= 0) {
                // Se a quantidade for 0 ou menos, remove o item
                cart.splice(itemIndex, 1);
            } else {
                cart[itemIndex].quantity = newQuantity;
            }
            CartManager.saveCartItems(cart);
            console.log("Quantidade atualizada. Carrinho atual:", cart);
        }
        return cart;
    }

    /**
     * Limpa completamente o carrinho.
     */
    static clearCart() {
        localStorage.removeItem(CART_STORAGE_KEY);
        console.log("Carrinho limpo.");
    }
}

export default CartManager;
